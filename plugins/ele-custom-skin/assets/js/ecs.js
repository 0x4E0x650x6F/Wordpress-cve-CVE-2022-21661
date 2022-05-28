
var ECS_hooks = {};

var ECS_Columns_Count=0;

function ECS_add_action(name, func) {
  if(!ECS_hooks[name]) ECS_hooks[name] = [];
  ECS_hooks[name].push(func);
}

function ECS_do_action(name, ...params){
  if(ECS_hooks[name]) 
     ECS_hooks[name].forEach(func => func(...params));
}