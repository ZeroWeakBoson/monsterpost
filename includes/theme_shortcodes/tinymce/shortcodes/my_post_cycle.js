frameworkShortcodeAtts={
	attributes:[
			{
				label:"How many posts to show?",
				id:"num",
				help:"This is how many recent posts will be displayed."
			},
			{
				label:"Which category to pull from? (for Blog posts)",
				id:"category",
				help:"Enter the slug of the category you'd like to pull posts from. Leave blank if you'd like to pull from all categories."
			},
			{
				label:"Image width",
				id:"thumb_width",
				help:"Set width for your featured images."
			},
			{
				label:"Image height",
				id:"thumb_height",
				help:"Set height for your featured images."
			},
			{
				label:"Effect",
				id:"effect",
				controlType:"select-control", 
				selectValues:['slide', 'fade', 'vertical'],
				defaultValue: 'slide',
				defaultText: 'slide',
				help:"Choose the transition effect."
			},
			{
				label:"Pagination",
				id:"pagination",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Enable or disable pagination."
			},
			{
				label:"Next & Prev navigation",
				id:"navigation",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Display next & prev navigation?"
			},
			{
				label:"Custom class",
				id:"custom_class",
				help:"Use this field if you want to use a custom class."
			}
	],
	defaultContent:"",
	shortcode:"post_cycle"
};