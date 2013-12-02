frameworkShortcodeAtts={
	attributes:[
			{
				label:"Icon Name",
				id:"icon_font",
				help:"In this field you need to specify the icon name that can be copied from the <u><a href='http://fontawesome.io/3.2.1/icons/' target='_blank'>website</a></u>. E.g. \"icon-music\".",
				item_class:"tupe_font_icon"
			},
			{
				label:"Icon Size",
				id:"icon_font_size",
				help:"Specify the icon image size in px or em. E.g. \"14px\".",
				item_class:"tupe_font_icon"
			},
			{
				label:"Icon Color",
				id:"icon_font_color",
				help:"Specify icon color in HEX format or input color title in English. E.g. \"#A52A2A\" or \"red\".",
				item_class:"tupe_font_icon"
			},
			{
				label:"Align",
				id:"align",
				controlType:"select-control",
				selectValues:['left', 'right', 'center', 'none'],
				defaultValue: 'left', 
				defaultText: 'left',
				help:"Choose icon's align."
			},
			{
				label:"Custom class",
				id:"custom_class",
				help:"Use this field if you want to use a custom class."
			}
	],
	defaultContent:"",
	shortcode:"icon"
};