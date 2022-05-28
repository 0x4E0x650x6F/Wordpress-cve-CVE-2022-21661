var ecsExecTime = new Date().getTime();
var EleCustomSkinPreview = elementorModules.frontend.handlers.Base.extend({
  
  loadedTemplates:{
    article:`<article  class="elementor-post elementor-grid-item  post type-post status-publish format-standard has-post-thumbnail hentry">
              [content]</article>`,
    wrapper:`<div id="ecs-preview" class="elementor-element  elementor-posts--thumbnail-top elementor-grid-[columns] elementor-grid-tablet-[columns_tablet] elementor-grid-mobile-[columns_mobile] elementor-widget elementor-widget-posts" data-element_type="widget" data-settings="{&quot;custom_is_display_conditions&quot;:&quot;yes&quot;,&quot;custom_columns&quot;:&quot;[columns]&quot;,&quot;custom_columns_tablet&quot;:&quot;[columns_tablet]&quot;,&quot;custom_columns_mobile&quot;:&quot;[columns_mobile]&quot;,&quot;custom_row_gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:35,&quot;sizes&quot;:[]}}" data-widget_type="posts.custom">
                <style>
                #ecs-preview article{margin:7px; }
                </style>  
                <h1>Preview</h1>
                <div class="elementor-widget-container"> <div class="elementor-posts-container elementor-posts elementor-grid elementor-posts--skin-custom">
                  [content]
                </div></div>
              </div>`
  },
  wrapper_template:{
    header:"",
    footer:""
  },
  article_template:{
    header:"",
    footer:""
  },
  previewArguments:{
    columns:3,
    columns_tablet:2,
    columns_mobile:1
  },
  originalContent:"",
  previewContent:"",
  
  parseTemplate: function parseTemplate(content){
    for (const [key, value] of Object.entries(this.previewArguments)) {
      replace = '\\['+key+'\\]';
      re = new RegExp(replace,"g");
      content = content.replace(re, value);
    }
    //console.log(content);
    return content;
  },
  setTemplate:function setTemplate(target){
    var templatePart = this.loadedTemplates[target].split("[content]");

    this[target + '_template'].header = templatePart[0];
    this[target + '_template'].footer = templatePart[1] ;
  },
  generateArticles:function generateArticles(){
    for(i=0; i < this.previewArguments.columns; i++){
      this.previewContent += this.article_template.header + this.originalContent + this.article_template.footer;
    }
  },
  generateContent: function generateContent(){
    this.generateArticles();
    this.previewContent = this.parseTemplate(this.wrapper_template.header) + this.previewContent + this.wrapper_template.footer;
  },
  destroyContent: function destroyContent(){
    this.previewContent="";
    jQuery('#ecs-preview').remove();
  },
  onInit: function onInit() {
    
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
    this.initPreview();
    this.run();
  },
  initPreview: function initPreview(){
    this.setTemplate('wrapper');
    this.setTemplate('article');
  },
  writePreview: function writePreview(){
    jQuery( this.previewContent ).insertAfter( "#elementor-add-new-section" );
    jQuery('#ecs-preview .elementor-element-overlay').remove();
    jQuery('#ecs-preview .elementor-element-edit-mode').removeClass( "elementor-element-edit-mode" );
    jQuery('#ecs-preview .elementor-element-editable').removeClass( "elementor-element-editable" );
  },
  checkArguments: function checkArguments(){
//add ability to add remove columns
    columns = 4;
    this.previewArguments.columns = columns;
  },
  onElementChange: function onElementChange() {
    var self = this;
    setTimeout(function(){
      self.run();
    }, 2000); 
  },
  getOriginal: function getOriginal(){
    this.originalContent=jQuery('.page-content .elementor-section-wrap').html();
  },
  run: function run(){
    if(ecsRunEvery(2000)){
        this.destroyContent();
        this.checkArguments();
        this.getOriginal();
        this.generateContent();
        this.writePreview();
      //console.log(this.previewContent+" sunt aici");
    }
  }
  
});

//now let's see if we can call it
jQuery(window).on('elementor/frontend/init', () => {

  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(EleCustomSkinPreview, {
      $element,
    });
  };
  elementorFrontend.hooks.addAction('frontend/element_ready/global', addHandler);

});

function ecsRunEvery( miliseconds ){
  if(new Date().getTime() < ecsExecTime + miliseconds) return false;
  ecsExecTime = new Date().getTime();
  return true;
  
}