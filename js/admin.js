// Not ideal, but works for now.
jQuery(document).ready(function(){
	jQuery('select#newstudent_parent option.level-1').remove();
	jQuery('ul#studentchecklist > li > label > input').remove();
	jQuery('ul#studentchecklist > li > label').css('cursor','default');
});