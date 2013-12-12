/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-facebook' : '&#xe000;',
			'icon-twitter' : '&#xe001;',
			'icon-google-plus' : '&#xe002;',
			'icon-pinterest' : '&#xe003;',
			'icon-feed' : '&#xe00c;',
			'icon-play-dark' : '&#xe01d;',
			'icon-grid' : '&#xe033;',
			'icon-list' : '&#xe035;',
			'icon-angle-left' : '&#xf104;',
			'icon-angle-right' : '&#xf105;',
			'icon-angle-up' : '&#xf106;',
			'icon-angle-down' : '&#xf107;',
			'icon-pencil' : '&#xe036;',
			'icon-books' : '&#xe038;',
			'icon-case-studies' : '&#xe037;',
			'icon-podcasts' : '&#xe03a;',
			'icon-home' : '&#xf015;',
			'icon-question-sign' : '&#xf059;',
			'icon-stumbleupon' : '&#xe00d;',
			'icon-videos' : '&#xe03b;',
			'icon-user-add' : '&#xe032;',
			'icon-dollar' : '&#xe034;',
			'icon-cog' : '&#xe03c;',
			'icon-edit' : '&#xe03d;',
			'icon-bullhorn' : '&#xf0a1;',
			'icon-database' : '&#xe040;',
			'icon-upload' : '&#xe041;',
			'icon-graduate' : '&#xe042;',
			'icon-cogs' : '&#xf085;',
			'icon-picture' : '&#xe03f;',
			'icon-locked' : '&#xe044;',
			'icon-envelope' : '&#xe029;',
			'icon-close' : '&#xe004;',
			'icon-search' : '&#xe005;',
			'icon-forward' : '&#xe006;',
			'icon-bubble' : '&#xe008;',
			'icon-tag' : '&#xf02b;',
			'icon-yes' : '&#xe007;',
			'icon-no' : '&#xe009;',
			'icon-linkedin-sign' : '&#xf08c;',
			'icon-monster' : '&#xe00b;',
			'icon-quote' : '&#xe00e;',
			'icon-list-2' : '&#xe00f;',
			'icon-quora' : '&#xe00a;',
			'icon-pen_' : '&#xe010;',
			'icon-pen' : '&#xe011;',
			'icon-banknote' : '&#xe012;',
			'icon-settings' : '&#xe013;',
			'icon-megaphone' : '&#xe014;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};