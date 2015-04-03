$(function(){

	$('textarea.editor-simple').ckeditor({
		toolbar: [
			{name: 'basicstyles', items: ['Bold', 'Italic']},
			{name: 'paragraph', items: ['NumberedList', 'BulletedList']},
			{name: 'links', items: ['Link', 'Unlink']},
			{name: 'styles', items: ['Format']},
			{name: 'tools', items: ['Maximize', '-', 'Source']},
		],
		entities_latin: false
	});


	$('textarea.editor-standard').ckeditor({
		entities_latin: false
	});

	jush.style('jush.css');
	jush.highlight_tag('pre');
	jush.highlight_tag('code');
	jush.highlight_tag('kbd');


});
