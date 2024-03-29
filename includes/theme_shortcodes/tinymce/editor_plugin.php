<?php
header("Content-Type:text/javascript");

//Setup URL to WordPress
$absolute_path = __FILE__;
$path_to_wp = explode( 'wp-content', $absolute_path );
$wp_url = $path_to_wp[0];

//Access WordPress
require_once( $wp_url.'/wp-load.php' );

//URL to TinyMCE plugin folder
$plugin_url = get_template_directory_uri().'/includes/theme_shortcodes/tinymce/';
?>
(function(){

	var icon_url = '<?php echo $plugin_url; ?>' + 'images/icon_shortcodes.png';

	tinymce.create(
		"tinymce.plugins.MyThemeShortcodes",
		{
			init: function(d,e) {

					d.addCommand( "myThemeOpenDialog",function(a,c){

						// Grab the selected text from the content editor.
						selectedText = '';

						if ( d.selection.getContent().length > 0 ) {

							selectedText = d.selection.getContent();

						} // End IF Statement

						myThemeSelectedShortcodeType = c.identifier;
						myThemeSelectedShortcodeTitle = c.title;

						jQuery.get(e+"/dialog.php",function(b){

							jQuery('#shortcode-options').addClass( 'shortcode-' + myThemeSelectedShortcodeType );

							// Skip the popup on certain shortcodes.

							switch ( myThemeSelectedShortcodeType ) {

				// warning

								case 'warning':

								var a = '[warning]'+selectedText+'[/warning]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// error

								case 'error':

								var a = '[error]'+selectedText+'[/error]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// succes

								case 'succes':

								var a = '[succes]'+selectedText+'[/succes]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// info

								case 'info':

								var a = '[info]'+selectedText+'[/info]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// subscribe form

								case 'subscribe_form':

								var a = '[subscribe_form]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// contact form

								case 'contact_form':

								var a = '[contact_form]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// feedback form

								case 'feedback_form':

								var a = '[feedback_form]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// dropcap

								case 'dropcap':

								var a = '[dropcap]'+selectedText+'[/dropcap]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// highlight

								case 'highlight':

								var a = '[highlight]'+selectedText+'[/highlight]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// media_desc

								case 'media_desc':

								var a = '[media_desc]'+selectedText+'[/media_desc]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// frame

								case 'frame':

								var a = '[frame align="none"]'+selectedText+'[/frame]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Horizontal Ruel

								case 'hr':

								var a = '[hr]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// List Unstyled

								case 'list_un':

								var a = '[list_un]'+selectedText+'[/list_un]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Check list

								case 'check_list':

								var a = '[check_list]'+selectedText+'[/check_list]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Check2 list

								case 'check2_list':

								var a = '[check2_list]'+selectedText+'[/check2_list]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Arrow list

								case 'arrow_list':

								var a = '[arrow_list]'+selectedText+'[/arrow_list]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Arrow2 list

								case 'arrow2_list':

								var a = '[arrow2_list]'+selectedText+'[/arrow2_list]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Star list

								case 'star_list':

								var a = '[star_list]'+selectedText+'[/star_list]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Plus list

								case 'plus_list':

								var a = '[plus_list]'+selectedText+'[/plus_list]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Minus list

								case 'minus_list':

								var a = '[minus_list]'+selectedText+'[/minus_list]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Circle list

								case 'circle_list':

								var a = '[circle_list]'+selectedText+'[/circle_list]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Custom list

								case 'custom_list':

								var a = '[custom_list]'+selectedText+'[/custom_list]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Small Horizontal Rule

								case 'sm_hr':

								var a = '[sm_hr]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// spacer

								case 'spacer':

								var a = '[spacer]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Clear

								case 'clear':

								var a = '[clear]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Extra Wrap

								case 'extra_wrap':

								var a = '[extra_wrap]'+selectedText+'[/extra_wrap]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// row

								case 'row':

								var a = '[row]'+selectedText+'[/row]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;


				// row inner

								case 'row_in':

								var a = '[row_in]'+selectedText+'[/row_in]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;


				// span1

								case 'span1':

								var a = '[span1]'+selectedText+'[/span1]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// span2

								case 'span2':

								var a = '[span2]'+selectedText+'[/span2]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// span3

								case 'span3':

								var a = '[span3]'+selectedText+'[/span3]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// span4

								case 'span4':

								var a = '[span4]'+selectedText+'[/span4]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// span5

								case 'span5':

								var a = '[span5]'+selectedText+'[/span5]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// span6

								case 'span6':

								var a = '[span6]'+selectedText+'[/span6]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// span7

								case 'span7':

								var a = '[span7]'+selectedText+'[/span7]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// span8

								case 'span8':

								var a = '[span8]'+selectedText+'[/span8]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// span9

								case 'span9':

								var a = '[span9]'+selectedText+'[/span9]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// span10

								case 'span10':

								var a = '[span10]'+selectedText+'[/span10]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// span11

								case 'span11':

								var a = '[span11]'+selectedText+'[/span11]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// span12

								case 'span12':

								var a = '[span12]'+selectedText+'[/span12]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// row_fluid

								case 'row_fluid':

								var a = '[row_fluid]'+selectedText+'[/row_fluid]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// dspan - 50x50

								case 'dspan_50x50':

								var a = '[span6]'+selectedText+'[/span6][span6][/span6]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// dspan - 75x25

								case 'dspan_75x25':

								var a = '[span8]'+selectedText+'[/span8][span4][/span4]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// dspan - 25x75

								case 'dspan_25x75':

								var a = '[span4]'+selectedText+'[/span4][span8][/span8]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// tspan - 33x33x33

								case 'tspan_33x33x33':

								var a = '[span4]'+selectedText+'[/span4][span4][/span4][span4][/span4]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// tspan - 50x25x25

								case 'tspan_50x25x25':

								var a = '[span6]'+selectedText+'[/span6][span3][/span3][span3][/span3]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// tspan - 25x50x25

								case 'tspan_25x50x25':

								var a = '[span3]'+selectedText+'[/span3][span6][/span6][span3][/span3]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// tspan - 25x25x50

								case 'tspan_25x25x50':

								var a = '[span3]'+selectedText+'[/span3][span3][/span3][span6][/span6]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// qspan - 25x25x25x25

								case 'qspan_25x25x25x25':

								var a = '[span3]'+selectedText+'[/span3][span3][/span3][span3][/span3][span3][/span3]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;


				 // blockquote

								case 'blockquote':

								var a = '[blockquote]'+selectedText+'[/blockquote]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;


				// address

								case 'address':

								var a = '[address]'+selectedText+'[/address]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// table

								case 'table':

								var a = '[table td1="#" td2="Title" td3="Value"] [td1] 1 [/td1] [td2] some title 1 [/td2] [td3] some value 1 [/td3] [/table]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;


				// tabs

								case 'tabs':

								var a = '[tabs tab1="Title #1" tab2="Title #2" tab3="Title #3"] [tab1] Tab 1 content... [/tab1] [tab2] Tab 2 content... [/tab2] [tab3] Tab 3 content... [/tab3] [/tabs]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

				// Accordion

								case 'accordions':

								var a = '[accordions] [accordion title="title1" visible="yes"] tab content [/accordion] [accordion title="title2"] another content tab [/accordion] [/accordions]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

					// Well

								case 'well':

								var a = '[well size="well-normal"]'+selectedText+'[/well]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

					// Question

								case 'question':

								var a = '[question author_name="" author_email=""]'+selectedText+'[/question]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

					// Answer

								case 'answer':

								var a = '[answer author_name="" author_email=""]'+selectedText+'[/answer]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

					// Template URL

								case 'template_url':

								var a = '[template_url]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

					// Related Posts

								case 'related_posts':

								var a = '[related_posts]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

					// mfc_lightbox

								case 'mfc_lightbox':

								var a = '[mfc_lightbox]'+selectedText+'[/mfc_lightbox]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);

								break;

								default:

								jQuery("#dialog").remove();
								jQuery("body").append(b);
								jQuery("#dialog").hide();
								var f=jQuery(window).width();
								b=jQuery(window).height();
								f=720<f?720:f;
								f-=80;
								b-=84;

							tb_show("Insert "+ myThemeSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=dialog");jQuery("#shortcode-options h3:first").text(""+c.title+" Shortcode Settings");

								break;

							} // End SWITCH Statement

						}

					)

					}
				);

				},

				createControl:function(d,e){

						if(d=="shortcodes_button"){

							d=e.createMenuButton("shortcodes_button",{
								title:"Insert Shortcode",
								image:icon_url,
								icons:false
								});

								var a=this;d.onRenderMenu.add(function(c,b){
								c=b.addMenu({title:"Row"});
									a.addWithDialog(c,"(px)","row");
									a.addWithDialog(c,"(%)","row_fluid");
								c=b.addMenu({title:"Columns"});
									a.addWithDialog(c,"1","span1");
									a.addWithDialog(c,"2","span2");
									a.addWithDialog(c,"3","span3");
									a.addWithDialog(c,"4","span4");
									a.addWithDialog(c,"5","span5");
									a.addWithDialog(c,"6","span6");
									a.addWithDialog(c,"7","span7");
									a.addWithDialog(c,"8","span8");
									a.addWithDialog(c,"9","span9");
									a.addWithDialog(c,"10","span10");
									a.addWithDialog(c,"11","span11");
									a.addWithDialog(c,"12","span12");
								c=b.addMenu({title:"2 Columns"});
									a.addWithDialog(c,"50% | 50%","dspan_50x50");
									a.addWithDialog(c,"75% | 25%","dspan_75x25");
									a.addWithDialog(c,"25% | 75%","dspan_25x75");
								c=b.addMenu({title:"3 Columns"});
									a.addWithDialog(c,"33.3% | 33.3% | 33.3%","tspan_33x33x33");
									a.addWithDialog(c,"50% | 25% | 25%","tspan_50x25x25");
									a.addWithDialog(c,"25% | 50% | 25%","tspan_25x50x25");
									a.addWithDialog(c,"25% | 25% | 50%","tspan_25x25x50");
								c=b.addMenu({title:"4 Columns"});;b.addSeparator();
									a.addWithDialog(c,"25% | 25% | 25% | 25%","qspan_25x25x25x25");
								c=b.addMenu({title:"Content"});
									a.addWithDialog(c,"Button","button");
									a.addWithDialog(c,"Label","label");
									a.addWithDialog(c,"Text Highlight","highlight");
									a.addWithDialog(c,"Drop Cap","dropcap");
									a.addWithDialog(c,"Icon","icon");
									a.addWithDialog(c,"Horizontal Rule","hr");
									a.addWithDialog(c,"Small Horizontal Rule","sm_hr");
									a.addWithDialog(c,"Spacer","spacer");
									a.addWithDialog(c,"Progressbar","progressbar");
								c=b.addMenu({title:"Interview"});
									a.addWithDialog(c,"Question","question");
									a.addWithDialog(c,"Answer","answer");
								c=b.addMenu({title:"Box"});
									a.addWithDialog(c,"Tabs","tabs");
									a.addWithDialog(c,"Accordion","accordions");
									a.addWithDialog(c,"Table","table");
									a.addWithDialog(c,"Hero Unit","hero_unit");
									a.addWithDialog(c,"Alert Box","alert_box");
									a.addWithDialog(c,"Well","well");
								c=b.addMenu({title:"Lists"});
									a.addWithDialog(c,"Unstyled","list_un");
									a.addWithDialog(c,"Check List","check_list");
									a.addWithDialog(c,"Check2 List","check2_list");
									a.addWithDialog(c,"Arrow List","arrow_list");
									a.addWithDialog(c,"Arrow2 List","arrow2_list");
									a.addWithDialog(c,"Star List","star_list");
									a.addWithDialog(c,"Plus List","plus_list");
									a.addWithDialog(c,"Minus List","minus_list");
									a.addWithDialog(c,"Circle List","circle_list");
									a.addWithDialog(c,"Custom List","custom_list");
								c=b.addMenu({title:"Gallery"});
									a.addWithDialog(c,"Presentation Post","post_cycle");
									a.addWithDialog(c,"Lightbox (Popup)","mfc_lightbox");
								c=b.addMenu({title:"Data"});
									a.addWithDialog(c,"Related Posts","related_posts");
									a.addWithDialog(c,"Categories","categories");
									a.addWithDialog(c,"Tags","tags");
								c=b.addMenu({title:"Media"});
									a.addWithDialog(c,"Google Map","map");
									a.addWithDialog(c,"Media Description","media_desc");
								c=b.addMenu({title:"Contact"});
									a.addWithDialog(c,"Contact Form","contact_form");
									a.addWithDialog(c,"Feedback Form","feedback_form");
									a.addWithDialog(c,"Subscribe Form","subscribe_form");
									a.addWithDialog(c,"Contact Follow List","contact_follow");
									a.addWithDialog(c,"Address","address");
								c=b.addMenu({title:"Other"});
									a.addWithDialog(c,"Template URL","template_url");
									a.addWithDialog(c,"Clear","clear");
									a.addWithDialog(c,"Extra Wrap","extra_wrap");
							});

							return d

						} // End IF Statement

						return null
					},

				addImmediate:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand("mceInsertContent",false,a)}})},

				addWithDialog:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand("myThemeOpenDialog",false,{title:e,identifier:a})}})},

				getInfo:function(){ return{longname:"Shortcode Generator",author:"VisualShortcodes.com",authorurl:"http://visualshortcodes.com",infourl:"http://visualshortcodes.com/shortcode-ninja",version:"1.0"} }
			}
		);

		tinymce.PluginManager.add("MyThemeShortcodes",tinymce.plugins.MyThemeShortcodes)
	}
)();
