/* Datatables and all its extenstions must be loaded in a single JS file for AngularJS version. ocLazyLoader executes each loaded JS file as per looad */
/*! DataTables 1.10.2
 * ©2008-2014 SpryMedia Ltd - datatables.net/license
 */
(function(za,O,l){var N=function(h){function T(a){var b,c,d={};h.each(a,function(e){if((b=e.match(/^([^A-Z]+?)([A-Z])/))&&-1!=="a aa ai ao as b fn i m o s ".indexOf(b[1]+" "))c=e.replace(b[0],b[2].toLowerCase()),d[c]=e,"o"===b[1]&&T(a[e])});a._hungarianMap=d}function G(a,b,c){a._hungarianMap||T(a);var d;h.each(b,function(e){d=a._hungarianMap[e];if(d!==l&&(c||b[d]===l))"o"===d.charAt(0)?(b[d]||(b[d]={}),h.extend(!0,b[d],b[e]),G(a[d],b[d],c)):b[d]=b[e]})}function N(a){var b=p.defaults.oLanguage,c=a.sZeroRecords;
!a.sEmptyTable&&(c&&"No data available in table"===b.sEmptyTable)&&D(a,a,"sZeroRecords","sEmptyTable");!a.sLoadingRecords&&(c&&"Loading..."===b.sLoadingRecords)&&D(a,a,"sZeroRecords","sLoadingRecords");a.sInfoThousands&&(a.sThousands=a.sInfoThousands);(a=a.sDecimal)&&cb(a)}function db(a){w(a,"ordering","bSort");w(a,"orderMulti","bSortMulti");w(a,"orderClasses","bSortClasses");w(a,"orderCellsTop","bSortCellsTop");w(a,"order","aaSorting");w(a,"orderFixed","aaSortingFixed");w(a,"paging","bPaginate");
w(a,"pagingType","sPaginationType");w(a,"pageLength","iDisplayLength");w(a,"searching","bFilter");if(a=a.aoSearchCols)for(var b=0,c=a.length;b<c;b++)a[b]&&G(p.models.oSearch,a[b])}function eb(a){w(a,"orderable","bSortable");w(a,"orderData","aDataSort");w(a,"orderSequence","asSorting");w(a,"orderDataType","sortDataType")}function fb(a){var a=a.oBrowser,b=h("<div/>").css({position:"absolute",top:0,left:0,height:1,width:1,overflow:"hidden"}).append(h("<div/>").css({position:"absolute",top:1,left:1,width:100,
overflow:"scroll"}).append(h('<div class="test"/>').css({width:"100%",height:10}))).appendTo("body"),c=b.find(".test");a.bScrollOversize=100===c[0].offsetWidth;a.bScrollbarLeft=1!==c.offset().left;b.remove()}function gb(a,b,c,d,e,f){var g,j=!1;c!==l&&(g=c,j=!0);for(;d!==e;)a.hasOwnProperty(d)&&(g=j?b(g,a[d],d,a):a[d],j=!0,d+=f);return g}function Aa(a,b){var c=p.defaults.column,d=a.aoColumns.length,c=h.extend({},p.models.oColumn,c,{nTh:b?b:O.createElement("th"),sTitle:c.sTitle?c.sTitle:b?b.innerHTML:
"",aDataSort:c.aDataSort?c.aDataSort:[d],mData:c.mData?c.mData:d,idx:d});a.aoColumns.push(c);c=a.aoPreSearchCols;c[d]=h.extend({},p.models.oSearch,c[d]);fa(a,d,null)}function fa(a,b,c){var b=a.aoColumns[b],d=a.oClasses,e=h(b.nTh);if(!b.sWidthOrig){b.sWidthOrig=e.attr("width")||null;var f=(e.attr("style")||"").match(/width:\s*(\d+[pxem%]+)/);f&&(b.sWidthOrig=f[1])}c!==l&&null!==c&&(eb(c),G(p.defaults.column,c),c.mDataProp!==l&&!c.mData&&(c.mData=c.mDataProp),c.sType&&(b._sManualType=c.sType),c.className&&
!c.sClass&&(c.sClass=c.className),h.extend(b,c),D(b,c,"sWidth","sWidthOrig"),"number"===typeof c.iDataSort&&(b.aDataSort=[c.iDataSort]),D(b,c,"aDataSort"));var g=b.mData,j=U(g),i=b.mRender?U(b.mRender):null,c=function(a){return"string"===typeof a&&-1!==a.indexOf("@")};b._bAttrSrc=h.isPlainObject(g)&&(c(g.sort)||c(g.type)||c(g.filter));b.fnGetData=function(a,b,c){var d=j(a,b,l,c);return i&&b?i(d,b,a,c):d};b.fnSetData=function(a,b,c){return Ba(g)(a,b,c)};a.oFeatures.bSort||(b.bSortable=!1,e.addClass(d.sSortableNone));
a=-1!==h.inArray("asc",b.asSorting);c=-1!==h.inArray("desc",b.asSorting);!b.bSortable||!a&&!c?(b.sSortingClass=d.sSortableNone,b.sSortingClassJUI=""):a&&!c?(b.sSortingClass=d.sSortableAsc,b.sSortingClassJUI=d.sSortJUIAscAllowed):!a&&c?(b.sSortingClass=d.sSortableDesc,b.sSortingClassJUI=d.sSortJUIDescAllowed):(b.sSortingClass=d.sSortable,b.sSortingClassJUI=d.sSortJUI)}function V(a){if(!1!==a.oFeatures.bAutoWidth){var b=a.aoColumns;Ca(a);for(var c=0,d=b.length;c<d;c++)b[c].nTh.style.width=b[c].sWidth}b=
a.oScroll;(""!==b.sY||""!==b.sX)&&W(a);u(a,null,"column-sizing",[a])}function ga(a,b){var c=X(a,"bVisible");return"number"===typeof c[b]?c[b]:null}function Y(a,b){var c=X(a,"bVisible"),c=h.inArray(b,c);return-1!==c?c:null}function Z(a){return X(a,"bVisible").length}function X(a,b){var c=[];h.map(a.aoColumns,function(a,e){a[b]&&c.push(e)});return c}function Da(a){var b=a.aoColumns,c=a.aoData,d=p.ext.type.detect,e,f,g,j,i,h,m,o,k;e=0;for(f=b.length;e<f;e++)if(m=b[e],k=[],!m.sType&&m._sManualType)m.sType=
m._sManualType;else if(!m.sType){g=0;for(j=d.length;g<j;g++){i=0;for(h=c.length;i<h&&!(k[i]===l&&(k[i]=A(a,i,e,"type")),o=d[g](k[i],a),!o||"html"===o);i++);if(o){m.sType=o;break}}m.sType||(m.sType="string")}}function hb(a,b,c,d){var e,f,g,j,i,n,m=a.aoColumns;if(b)for(e=b.length-1;0<=e;e--){n=b[e];var o=n.targets!==l?n.targets:n.aTargets;h.isArray(o)||(o=[o]);f=0;for(g=o.length;f<g;f++)if("number"===typeof o[f]&&0<=o[f]){for(;m.length<=o[f];)Aa(a);d(o[f],n)}else if("number"===typeof o[f]&&0>o[f])d(m.length+
o[f],n);else if("string"===typeof o[f]){j=0;for(i=m.length;j<i;j++)("_all"==o[f]||h(m[j].nTh).hasClass(o[f]))&&d(j,n)}}if(c){e=0;for(a=c.length;e<a;e++)d(e,c[e])}}function I(a,b,c,d){var e=a.aoData.length,f=h.extend(!0,{},p.models.oRow,{src:c?"dom":"data"});f._aData=b;a.aoData.push(f);for(var b=a.aoColumns,f=0,g=b.length;f<g;f++)c&&Ea(a,e,f,A(a,e,f)),b[f].sType=null;a.aiDisplayMaster.push(e);(c||!a.oFeatures.bDeferRender)&&Fa(a,e,c,d);return e}function ha(a,b){var c;b instanceof h||(b=h(b));return b.map(function(b,
e){c=ia(a,e);return I(a,c.data,e,c.cells)})}function A(a,b,c,d){var e=a.iDraw,f=a.aoColumns[c],g=a.aoData[b]._aData,j=f.sDefaultContent,c=f.fnGetData(g,d,{settings:a,row:b,col:c});if(c===l)return a.iDrawError!=e&&null===j&&(P(a,0,"Requested unknown parameter "+("function"==typeof f.mData?"{function}":"'"+f.mData+"'")+" for row "+b,4),a.iDrawError=e),j;if((c===g||null===c)&&null!==j)c=j;else if("function"===typeof c)return c.call(g);return null===c&&"display"==d?"":c}function Ea(a,b,c,d){a.aoColumns[c].fnSetData(a.aoData[b]._aData,
d,{settings:a,row:b,col:c})}function Ga(a){return h.map(a.match(/(\\.|[^\.])+/g),function(a){return a.replace(/\\./g,".")})}function U(a){if(h.isPlainObject(a)){var b={};h.each(a,function(a,c){c&&(b[a]=U(c))});return function(a,c,f,g){var j=b[c]||b._;return j!==l?j(a,c,f,g):a}}if(null===a)return function(a){return a};if("function"===typeof a)return function(b,c,f,g){return a(b,c,f,g)};if("string"===typeof a&&(-1!==a.indexOf(".")||-1!==a.indexOf("[")||-1!==a.indexOf("("))){var c=function(a,b,f){var g,
j;if(""!==f){j=Ga(f);for(var i=0,h=j.length;i<h;i++){f=j[i].match($);g=j[i].match(Q);if(f){j[i]=j[i].replace($,"");""!==j[i]&&(a=a[j[i]]);g=[];j.splice(0,i+1);j=j.join(".");i=0;for(h=a.length;i<h;i++)g.push(c(a[i],b,j));a=f[0].substring(1,f[0].length-1);a=""===a?g:g.join(a);break}else if(g){j[i]=j[i].replace(Q,"");a=a[j[i]]();continue}if(null===a||a[j[i]]===l)return l;a=a[j[i]]}}return a};return function(b,e){return c(b,e,a)}}return function(b){return b[a]}}function Ba(a){if(h.isPlainObject(a))return Ba(a._);
if(null===a)return function(){};if("function"===typeof a)return function(b,d,e){a(b,"set",d,e)};if("string"===typeof a&&(-1!==a.indexOf(".")||-1!==a.indexOf("[")||-1!==a.indexOf("("))){var b=function(a,d,e){var e=Ga(e),f;f=e[e.length-1];for(var g,j,i=0,h=e.length-1;i<h;i++){g=e[i].match($);j=e[i].match(Q);if(g){e[i]=e[i].replace($,"");a[e[i]]=[];f=e.slice();f.splice(0,i+1);g=f.join(".");j=0;for(h=d.length;j<h;j++)f={},b(f,d[j],g),a[e[i]].push(f);return}j&&(e[i]=e[i].replace(Q,""),a=a[e[i]](d));if(null===
a[e[i]]||a[e[i]]===l)a[e[i]]={};a=a[e[i]]}if(f.match(Q))a[f.replace(Q,"")](d);else a[f.replace($,"")]=d};return function(c,d){return b(c,d,a)}}return function(b,d){b[a]=d}}function Ha(a){return C(a.aoData,"_aData")}function ja(a){a.aoData.length=0;a.aiDisplayMaster.length=0;a.aiDisplay.length=0}function ka(a,b,c){for(var d=-1,e=0,f=a.length;e<f;e++)a[e]==b?d=e:a[e]>b&&a[e]--; -1!=d&&c===l&&a.splice(d,1)}function la(a,b,c,d){var e=a.aoData[b],f;if("dom"===c||(!c||"auto"===c)&&"dom"===e.src)e._aData=
ia(a,e).data;else{var g=e.anCells,j;if(g){c=0;for(f=g.length;c<f;c++){for(j=g[c];j.childNodes.length;)j.removeChild(j.firstChild);g[c].innerHTML=A(a,b,c,"display")}}}e._aSortData=null;e._aFilterData=null;a=a.aoColumns;if(d!==l)a[d].sType=null;else{c=0;for(f=a.length;c<f;c++)a[c].sType=null}Ia(e)}function ia(a,b){var c=[],d=[],e=b.firstChild,f,g,j,i=0,n,m=a.aoColumns,o=function(a,b,c){"string"===typeof a&&(b=a.indexOf("@"),-1!==b&&(a=a.substring(b+1),j["@"+a]=c.getAttribute(a)))},k=function(a){g=m[i];
n=h.trim(a.innerHTML);g&&g._bAttrSrc?(j={display:n},o(g.mData.sort,j,a),o(g.mData.type,j,a),o(g.mData.filter,j,a),c.push(j)):c.push(n);i++};if(e)for(;e;){f=e.nodeName.toUpperCase();if("TD"==f||"TH"==f)k(e),d.push(e);e=e.nextSibling}else{d=b.anCells;e=0;for(f=d.length;e<f;e++)k(d[e])}return{data:c,cells:d}}function Fa(a,b,c,d){var e=a.aoData[b],f=e._aData,g=[],j,i,h,m,o;if(null===e.nTr){j=c||O.createElement("tr");e.nTr=j;e.anCells=g;j._DT_RowIndex=b;Ia(e);m=0;for(o=a.aoColumns.length;m<o;m++){h=a.aoColumns[m];
i=c?d[m]:O.createElement(h.sCellType);g.push(i);if(!c||h.mRender||h.mData!==m)i.innerHTML=A(a,b,m,"display");h.sClass&&(i.className+=" "+h.sClass);h.bVisible&&!c?j.appendChild(i):!h.bVisible&&c&&i.parentNode.removeChild(i);h.fnCreatedCell&&h.fnCreatedCell.call(a.oInstance,i,A(a,b,m),f,b,m)}u(a,"aoRowCreatedCallback",null,[j,f,b])}e.nTr.setAttribute("role","row")}function Ia(a){var b=a.nTr,c=a._aData;if(b){c.DT_RowId&&(b.id=c.DT_RowId);if(c.DT_RowClass){var d=c.DT_RowClass.split(" ");a.__rowc=a.__rowc?
Ja(a.__rowc.concat(d)):d;h(b).removeClass(a.__rowc.join(" ")).addClass(c.DT_RowClass)}c.DT_RowData&&h(b).data(c.DT_RowData)}}function ib(a){var b,c,d,e,f,g=a.nTHead,j=a.nTFoot,i=0===h("th, td",g).length,n=a.oClasses,m=a.aoColumns;i&&(e=h("<tr/>").appendTo(g));b=0;for(c=m.length;b<c;b++)f=m[b],d=h(f.nTh).addClass(f.sClass),i&&d.appendTo(e),a.oFeatures.bSort&&(d.addClass(f.sSortingClass),!1!==f.bSortable&&(d.attr("tabindex",a.iTabIndex).attr("aria-controls",a.sTableId),Ka(a,f.nTh,b))),f.sTitle!=d.html()&&
d.html(f.sTitle),La(a,"header")(a,d,f,n);i&&aa(a.aoHeader,g);h(g).find(">tr").attr("role","row");h(g).find(">tr>th, >tr>td").addClass(n.sHeaderTH);h(j).find(">tr>th, >tr>td").addClass(n.sFooterTH);if(null!==j){a=a.aoFooter[0];b=0;for(c=a.length;b<c;b++)f=m[b],f.nTf=a[b].cell,f.sClass&&h(f.nTf).addClass(f.sClass)}}function ba(a,b,c){var d,e,f,g=[],j=[],i=a.aoColumns.length,n;if(b){c===l&&(c=!1);d=0;for(e=b.length;d<e;d++){g[d]=b[d].slice();g[d].nTr=b[d].nTr;for(f=i-1;0<=f;f--)!a.aoColumns[f].bVisible&&
!c&&g[d].splice(f,1);j.push([])}d=0;for(e=g.length;d<e;d++){if(a=g[d].nTr)for(;f=a.firstChild;)a.removeChild(f);f=0;for(b=g[d].length;f<b;f++)if(n=i=1,j[d][f]===l){a.appendChild(g[d][f].cell);for(j[d][f]=1;g[d+i]!==l&&g[d][f].cell==g[d+i][f].cell;)j[d+i][f]=1,i++;for(;g[d][f+n]!==l&&g[d][f].cell==g[d][f+n].cell;){for(c=0;c<i;c++)j[d+c][f+n]=1;n++}h(g[d][f].cell).attr("rowspan",i).attr("colspan",n)}}}}function K(a){var b=u(a,"aoPreDrawCallback","preDraw",[a]);if(-1!==h.inArray(!1,b))B(a,!1);else{var b=
[],c=0,d=a.asStripeClasses,e=d.length,f=a.oLanguage,g=a.iInitDisplayStart,j="ssp"==z(a),i=a.aiDisplay;a.bDrawing=!0;g!==l&&-1!==g&&(a._iDisplayStart=j?g:g>=a.fnRecordsDisplay()?0:g,a.iInitDisplayStart=-1);var g=a._iDisplayStart,n=a.fnDisplayEnd();if(a.bDeferLoading)a.bDeferLoading=!1,a.iDraw++,B(a,!1);else if(j){if(!a.bDestroying&&!jb(a))return}else a.iDraw++;if(0!==i.length){f=j?a.aoData.length:n;for(j=j?0:g;j<f;j++){var m=i[j],o=a.aoData[m];null===o.nTr&&Fa(a,m);m=o.nTr;if(0!==e){var k=d[c%e];o._sRowStripe!=
k&&(h(m).removeClass(o._sRowStripe).addClass(k),o._sRowStripe=k)}u(a,"aoRowCallback",null,[m,o._aData,c,j]);b.push(m);c++}}else c=f.sZeroRecords,1==a.iDraw&&"ajax"==z(a)?c=f.sLoadingRecords:f.sEmptyTable&&0===a.fnRecordsTotal()&&(c=f.sEmptyTable),b[0]=h("<tr/>",{"class":e?d[0]:""}).append(h("<td />",{valign:"top",colSpan:Z(a),"class":a.oClasses.sRowEmpty}).html(c))[0];u(a,"aoHeaderCallback","header",[h(a.nTHead).children("tr")[0],Ha(a),g,n,i]);u(a,"aoFooterCallback","footer",[h(a.nTFoot).children("tr")[0],
Ha(a),g,n,i]);d=h(a.nTBody);d.children().detach();d.append(h(b));u(a,"aoDrawCallback","draw",[a]);a.bSorted=!1;a.bFiltered=!1;a.bDrawing=!1}}function L(a,b){var c=a.oFeatures,d=c.bFilter;c.bSort&&kb(a);d?ca(a,a.oPreviousSearch):a.aiDisplay=a.aiDisplayMaster.slice();!0!==b&&(a._iDisplayStart=0);a._drawHold=b;K(a);a._drawHold=!1}function lb(a){var b=a.oClasses,c=h(a.nTable),c=h("<div/>").insertBefore(c),d=a.oFeatures,e=h("<div/>",{id:a.sTableId+"_wrapper","class":b.sWrapper+(a.nTFoot?"":" "+b.sNoFooter)});
a.nHolding=c[0];a.nTableWrapper=e[0];a.nTableReinsertBefore=a.nTable.nextSibling;for(var f=a.sDom.split(""),g,j,i,n,m,o,k=0;k<f.length;k++){g=null;j=f[k];if("<"==j){i=h("<div/>")[0];n=f[k+1];if("'"==n||'"'==n){m="";for(o=2;f[k+o]!=n;)m+=f[k+o],o++;"H"==m?m=b.sJUIHeader:"F"==m&&(m=b.sJUIFooter);-1!=m.indexOf(".")?(n=m.split("."),i.id=n[0].substr(1,n[0].length-1),i.className=n[1]):"#"==m.charAt(0)?i.id=m.substr(1,m.length-1):i.className=m;k+=o}e.append(i);e=h(i)}else if(">"==j)e=e.parent();else if("l"==
j&&d.bPaginate&&d.bLengthChange)g=mb(a);else if("f"==j&&d.bFilter)g=nb(a);else if("r"==j&&d.bProcessing)g=ob(a);else if("t"==j)g=pb(a);else if("i"==j&&d.bInfo)g=qb(a);else if("p"==j&&d.bPaginate)g=rb(a);else if(0!==p.ext.feature.length){i=p.ext.feature;o=0;for(n=i.length;o<n;o++)if(j==i[o].cFeature){g=i[o].fnInit(a);break}}g&&(i=a.aanFeatures,i[j]||(i[j]=[]),i[j].push(g),e.append(g))}c.replaceWith(e)}function aa(a,b){var c=h(b).children("tr"),d,e,f,g,j,i,n,m,o,k;a.splice(0,a.length);f=0;for(i=c.length;f<
i;f++)a.push([]);f=0;for(i=c.length;f<i;f++){d=c[f];for(e=d.firstChild;e;){if("TD"==e.nodeName.toUpperCase()||"TH"==e.nodeName.toUpperCase()){m=1*e.getAttribute("colspan");o=1*e.getAttribute("rowspan");m=!m||0===m||1===m?1:m;o=!o||0===o||1===o?1:o;g=0;for(j=a[f];j[g];)g++;n=g;k=1===m?!0:!1;for(j=0;j<m;j++)for(g=0;g<o;g++)a[f+g][n+j]={cell:e,unique:k},a[f+g].nTr=d}e=e.nextSibling}}}function ma(a,b,c){var d=[];c||(c=a.aoHeader,b&&(c=[],aa(c,b)));for(var b=0,e=c.length;b<e;b++)for(var f=0,g=c[b].length;f<
g;f++)if(c[b][f].unique&&(!d[f]||!a.bSortCellsTop))d[f]=c[b][f].cell;return d}function na(a,b,c){u(a,"aoServerParams","serverParams",[b]);if(b&&h.isArray(b)){var d={},e=/(.*?)\[\]$/;h.each(b,function(a,b){var c=b.name.match(e);c?(c=c[0],d[c]||(d[c]=[]),d[c].push(b.value)):d[b.name]=b.value});b=d}var f,g=a.ajax,j=a.oInstance;if(h.isPlainObject(g)&&g.data){f=g.data;var i=h.isFunction(f)?f(b):f,b=h.isFunction(f)&&i?i:h.extend(!0,b,i);delete g.data}i={data:b,success:function(b){var d=b.error||b.sError;
d&&a.oApi._fnLog(a,0,d);a.json=b;u(a,null,"xhr",[a,b]);c(b)},dataType:"json",cache:!1,type:a.sServerMethod,error:function(b,c){var d=a.oApi._fnLog;"parsererror"==c?d(a,0,"Invalid JSON response",1):4===b.readyState&&d(a,0,"Ajax error",7);B(a,!1)}};a.oAjaxData=b;u(a,null,"preXhr",[a,b]);a.fnServerData?a.fnServerData.call(j,a.sAjaxSource,h.map(b,function(a,b){return{name:b,value:a}}),c,a):a.sAjaxSource||"string"===typeof g?a.jqXHR=h.ajax(h.extend(i,{url:g||a.sAjaxSource})):h.isFunction(g)?a.jqXHR=g.call(j,
b,c,a):(a.jqXHR=h.ajax(h.extend(i,g)),g.data=f)}function jb(a){return a.bAjaxDataGet?(a.iDraw++,B(a,!0),na(a,sb(a),function(b){tb(a,b)}),!1):!0}function sb(a){var b=a.aoColumns,c=b.length,d=a.oFeatures,e=a.oPreviousSearch,f=a.aoPreSearchCols,g,j=[],i,n,m,o=R(a);g=a._iDisplayStart;i=!1!==d.bPaginate?a._iDisplayLength:-1;var k=function(a,b){j.push({name:a,value:b})};k("sEcho",a.iDraw);k("iColumns",c);k("sColumns",C(b,"sName").join(","));k("iDisplayStart",g);k("iDisplayLength",i);var l={draw:a.iDraw,
columns:[],order:[],start:g,length:i,search:{value:e.sSearch,regex:e.bRegex}};for(g=0;g<c;g++)n=b[g],m=f[g],i="function"==typeof n.mData?"function":n.mData,l.columns.push({data:i,name:n.sName,searchable:n.bSearchable,orderable:n.bSortable,search:{value:m.sSearch,regex:m.bRegex}}),k("mDataProp_"+g,i),d.bFilter&&(k("sSearch_"+g,m.sSearch),k("bRegex_"+g,m.bRegex),k("bSearchable_"+g,n.bSearchable)),d.bSort&&k("bSortable_"+g,n.bSortable);d.bFilter&&(k("sSearch",e.sSearch),k("bRegex",e.bRegex));d.bSort&&
(h.each(o,function(a,b){l.order.push({column:b.col,dir:b.dir});k("iSortCol_"+a,b.col);k("sSortDir_"+a,b.dir)}),k("iSortingCols",o.length));b=p.ext.legacy.ajax;return null===b?a.sAjaxSource?j:l:b?j:l}function tb(a,b){var c=b.sEcho!==l?b.sEcho:b.draw,d=b.iTotalRecords!==l?b.iTotalRecords:b.recordsTotal,e=b.iTotalDisplayRecords!==l?b.iTotalDisplayRecords:b.recordsFiltered;if(c){if(1*c<a.iDraw)return;a.iDraw=1*c}ja(a);a._iRecordsTotal=parseInt(d,10);a._iRecordsDisplay=parseInt(e,10);c=oa(a,b);d=0;for(e=
c.length;d<e;d++)I(a,c[d]);a.aiDisplay=a.aiDisplayMaster.slice();a.bAjaxDataGet=!1;K(a);a._bInitComplete||pa(a,b);a.bAjaxDataGet=!0;B(a,!1)}function oa(a,b){var c=h.isPlainObject(a.ajax)&&a.ajax.dataSrc!==l?a.ajax.dataSrc:a.sAjaxDataProp;return"data"===c?b.aaData||b[c]:""!==c?U(c)(b):b}function nb(a){var b=a.oClasses,c=a.sTableId,d=a.oLanguage,e=a.oPreviousSearch,f=a.aanFeatures,g='<input type="search" class="'+b.sFilterInput+'"/>',j=d.sSearch,j=j.match(/_INPUT_/)?j.replace("_INPUT_",g):j+g,b=h("<div/>",
{id:!f.f?c+"_filter":null,"class":b.sFilter}).append(h("<label/>").append(j)),f=function(){var b=!this.value?"":this.value;b!=e.sSearch&&(ca(a,{sSearch:b,bRegex:e.bRegex,bSmart:e.bSmart,bCaseInsensitive:e.bCaseInsensitive}),a._iDisplayStart=0,K(a))},i=h("input",b).val(e.sSearch).attr("placeholder",d.sSearchPlaceholder).bind("keyup.DT search.DT input.DT paste.DT cut.DT","ssp"===z(a)?Ma(f,400):f).bind("keypress.DT",function(a){if(13==a.keyCode)return!1}).attr("aria-controls",c);h(a.nTable).on("search.dt.DT",
function(b,c){if(a===c)try{i[0]!==O.activeElement&&i.val(e.sSearch)}catch(d){}});return b[0]}function ca(a,b,c){var d=a.oPreviousSearch,e=a.aoPreSearchCols,f=function(a){d.sSearch=a.sSearch;d.bRegex=a.bRegex;d.bSmart=a.bSmart;d.bCaseInsensitive=a.bCaseInsensitive};Da(a);if("ssp"!=z(a)){ub(a,b.sSearch,c,b.bEscapeRegex!==l?!b.bEscapeRegex:b.bRegex,b.bSmart,b.bCaseInsensitive);f(b);for(b=0;b<e.length;b++)vb(a,e[b].sSearch,b,e[b].bEscapeRegex!==l?!e[b].bEscapeRegex:e[b].bRegex,e[b].bSmart,e[b].bCaseInsensitive);
wb(a)}else f(b);a.bFiltered=!0;u(a,null,"search",[a])}function wb(a){for(var b=p.ext.search,c=a.aiDisplay,d,e,f=0,g=b.length;f<g;f++){for(var j=[],i=0,h=c.length;i<h;i++)e=c[i],d=a.aoData[e],b[f](a,d._aFilterData,e,d._aData,i)&&j.push(e);c.length=0;c.push.apply(c,j)}}function vb(a,b,c,d,e,f){if(""!==b)for(var g=a.aiDisplay,d=Na(b,d,e,f),e=g.length-1;0<=e;e--)b=a.aoData[g[e]]._aFilterData[c],d.test(b)||g.splice(e,1)}function ub(a,b,c,d,e,f){var d=Na(b,d,e,f),e=a.oPreviousSearch.sSearch,f=a.aiDisplayMaster,
g;0!==p.ext.search.length&&(c=!0);g=xb(a);if(0>=b.length)a.aiDisplay=f.slice();else{if(g||c||e.length>b.length||0!==b.indexOf(e)||a.bSorted)a.aiDisplay=f.slice();b=a.aiDisplay;for(c=b.length-1;0<=c;c--)d.test(a.aoData[b[c]]._sFilterRow)||b.splice(c,1)}}function Na(a,b,c,d){a=b?a:Oa(a);c&&(a="^(?=.*?"+h.map(a.match(/"[^"]+"|[^ ]+/g)||"",function(a){return'"'===a.charAt(0)?a.match(/^"(.*)"$/)[1]:a}).join(")(?=.*?")+").*$");return RegExp(a,d?"i":"")}function Oa(a){return a.replace(Vb,"\\$1")}function xb(a){var b=
a.aoColumns,c,d,e,f,g,j,i,h,m=p.ext.type.search;c=!1;d=0;for(f=a.aoData.length;d<f;d++)if(h=a.aoData[d],!h._aFilterData){j=[];e=0;for(g=b.length;e<g;e++)c=b[e],c.bSearchable?(i=A(a,d,e,"filter"),m[c.sType]&&(i=m[c.sType](i)),null===i&&(i=""),"string"!==typeof i&&i.toString&&(i=i.toString())):i="",i.indexOf&&-1!==i.indexOf("&")&&(qa.innerHTML=i,i=Wb?qa.textContent:qa.innerText),i.replace&&(i=i.replace(/[\r\n]/g,"")),j.push(i);h._aFilterData=j;h._sFilterRow=j.join("  ");c=!0}return c}function yb(a){return{search:a.sSearch,
smart:a.bSmart,regex:a.bRegex,caseInsensitive:a.bCaseInsensitive}}function zb(a){return{sSearch:a.search,bSmart:a.smart,bRegex:a.regex,bCaseInsensitive:a.caseInsensitive}}function qb(a){var b=a.sTableId,c=a.aanFeatures.i,d=h("<div/>",{"class":a.oClasses.sInfo,id:!c?b+"_info":null});c||(a.aoDrawCallback.push({fn:Ab,sName:"information"}),d.attr("role","status").attr("aria-live","polite"),h(a.nTable).attr("aria-describedby",b+"_info"));return d[0]}function Ab(a){var b=a.aanFeatures.i;if(0!==b.length){var c=
a.oLanguage,d=a._iDisplayStart+1,e=a.fnDisplayEnd(),f=a.fnRecordsTotal(),g=a.fnRecordsDisplay(),j=g?c.sInfo:c.sInfoEmpty;g!==f&&(j+=" "+c.sInfoFiltered);j+=c.sInfoPostFix;j=Bb(a,j);c=c.fnInfoCallback;null!==c&&(j=c.call(a.oInstance,a,d,e,f,g,j));h(b).html(j)}}function Bb(a,b){var c=a.fnFormatNumber,d=a._iDisplayStart+1,e=a._iDisplayLength,f=a.fnRecordsDisplay(),g=-1===e;return b.replace(/_START_/g,c.call(a,d)).replace(/_END_/g,c.call(a,a.fnDisplayEnd())).replace(/_MAX_/g,c.call(a,a.fnRecordsTotal())).replace(/_TOTAL_/g,
c.call(a,f)).replace(/_PAGE_/g,c.call(a,g?1:Math.ceil(d/e))).replace(/_PAGES_/g,c.call(a,g?1:Math.ceil(f/e)))}function ra(a){var b,c,d=a.iInitDisplayStart,e=a.aoColumns,f;c=a.oFeatures;if(a.bInitialised){lb(a);ib(a);ba(a,a.aoHeader);ba(a,a.aoFooter);B(a,!0);c.bAutoWidth&&Ca(a);b=0;for(c=e.length;b<c;b++)f=e[b],f.sWidth&&(f.nTh.style.width=s(f.sWidth));L(a);e=z(a);"ssp"!=e&&("ajax"==e?na(a,[],function(c){var f=oa(a,c);for(b=0;b<f.length;b++)I(a,f[b]);a.iInitDisplayStart=d;L(a);B(a,!1);pa(a,c)},a):
(B(a,!1),pa(a)))}else setTimeout(function(){ra(a)},200)}function pa(a,b){a._bInitComplete=!0;b&&V(a);u(a,"aoInitComplete","init",[a,b])}function Pa(a,b){var c=parseInt(b,10);a._iDisplayLength=c;Qa(a);u(a,null,"length",[a,c])}function mb(a){for(var b=a.oClasses,c=a.sTableId,d=a.aLengthMenu,e=h.isArray(d[0]),f=e?d[0]:d,d=e?d[1]:d,e=h("<select/>",{name:c+"_length","aria-controls":c,"class":b.sLengthSelect}),g=0,j=f.length;g<j;g++)e[0][g]=new Option(d[g],f[g]);var i=h("<div><label/></div>").addClass(b.sLength);
a.aanFeatures.l||(i[0].id=c+"_length");i.children().append(a.oLanguage.sLengthMenu.replace("_MENU_",e[0].outerHTML));h("select",i).val(a._iDisplayLength).bind("change.DT",function(){Pa(a,h(this).val());K(a)});h(a.nTable).bind("length.dt.DT",function(b,c,d){a===c&&h("select",i).val(d)});return i[0]}function rb(a){var b=a.sPaginationType,c=p.ext.pager[b],d="function"===typeof c,e=function(a){K(a)},b=h("<div/>").addClass(a.oClasses.sPaging+b)[0],f=a.aanFeatures;d||c.fnInit(a,b,e);f.p||(b.id=a.sTableId+
"_paginate",a.aoDrawCallback.push({fn:function(a){if(d){var b=a._iDisplayStart,i=a._iDisplayLength,h=a.fnRecordsDisplay(),m=-1===i,b=m?0:Math.ceil(b/i),i=m?1:Math.ceil(h/i),h=c(b,i),o,m=0;for(o=f.p.length;m<o;m++)La(a,"pageButton")(a,f.p[m],m,h,b,i)}else c.fnUpdate(a,e)},sName:"pagination"}));return b}function Ra(a,b,c){var d=a._iDisplayStart,e=a._iDisplayLength,f=a.fnRecordsDisplay();0===f||-1===e?d=0:"number"===typeof b?(d=b*e,d>f&&(d=0)):"first"==b?d=0:"previous"==b?(d=0<=e?d-e:0,0>d&&(d=0)):"next"==
b?d+e<f&&(d+=e):"last"==b?d=Math.floor((f-1)/e)*e:P(a,0,"Unknown paging action: "+b,5);b=a._iDisplayStart!==d;a._iDisplayStart=d;b&&(u(a,null,"page",[a]),c&&K(a));return b}function ob(a){return h("<div/>",{id:!a.aanFeatures.r?a.sTableId+"_processing":null,"class":a.oClasses.sProcessing}).html(a.oLanguage.sProcessing).insertBefore(a.nTable)[0]}function B(a,b){a.oFeatures.bProcessing&&h(a.aanFeatures.r).css("display",b?"block":"none");u(a,null,"processing",[a,b])}function pb(a){var b=h(a.nTable);b.attr("role",
"grid");var c=a.oScroll;if(""===c.sX&&""===c.sY)return a.nTable;var d=c.sX,e=c.sY,f=a.oClasses,g=b.children("caption"),j=g.length?g[0]._captionSide:null,i=h(b[0].cloneNode(!1)),n=h(b[0].cloneNode(!1)),m=b.children("tfoot");c.sX&&"100%"===b.attr("width")&&b.removeAttr("width");m.length||(m=null);c=h("<div/>",{"class":f.sScrollWrapper}).append(h("<div/>",{"class":f.sScrollHead}).css({overflow:"hidden",position:"relative",border:0,width:d?!d?null:s(d):"100%"}).append(h("<div/>",{"class":f.sScrollHeadInner}).css({"box-sizing":"content-box",
width:c.sXInner||"100%"}).append(i.removeAttr("id").css("margin-left",0).append(b.children("thead")))).append("top"===j?g:null)).append(h("<div/>",{"class":f.sScrollBody}).css({overflow:"auto",height:!e?null:s(e),width:!d?null:s(d)}).append(b));m&&c.append(h("<div/>",{"class":f.sScrollFoot}).css({overflow:"hidden",border:0,width:d?!d?null:s(d):"100%"}).append(h("<div/>",{"class":f.sScrollFootInner}).append(n.removeAttr("id").css("margin-left",0).append(b.children("tfoot")))).append("bottom"===j?g:
null));var b=c.children(),o=b[0],f=b[1],k=m?b[2]:null;d&&h(f).scroll(function(){var a=this.scrollLeft;o.scrollLeft=a;m&&(k.scrollLeft=a)});a.nScrollHead=o;a.nScrollBody=f;a.nScrollFoot=k;a.aoDrawCallback.push({fn:W,sName:"scrolling"});return c[0]}function W(a){var b=a.oScroll,c=b.sX,d=b.sXInner,e=b.sY,f=b.iBarWidth,g=h(a.nScrollHead),j=g[0].style,i=g.children("div"),n=i[0].style,m=i.children("table"),i=a.nScrollBody,o=h(i),k=i.style,l=h(a.nScrollFoot).children("div"),p=l.children("table"),r=h(a.nTHead),
q=h(a.nTable),da=q[0],M=da.style,J=a.nTFoot?h(a.nTFoot):null,u=a.oBrowser,v=u.bScrollOversize,y,t,x,w,z,A=[],B=[],C=[],D,E=function(a){a=a.style;a.paddingTop="0";a.paddingBottom="0";a.borderTopWidth="0";a.borderBottomWidth="0";a.height=0};q.children("thead, tfoot").remove();z=r.clone().prependTo(q);y=r.find("tr");x=z.find("tr");z.find("th, td").removeAttr("tabindex");J&&(w=J.clone().prependTo(q),t=J.find("tr"),w=w.find("tr"));c||(k.width="100%",g[0].style.width="100%");h.each(ma(a,z),function(b,c){D=
ga(a,b);c.style.width=a.aoColumns[D].sWidth});J&&F(function(a){a.style.width=""},w);b.bCollapse&&""!==e&&(k.height=o[0].offsetHeight+r[0].offsetHeight+"px");g=q.outerWidth();if(""===c){if(M.width="100%",v&&(q.find("tbody").height()>i.offsetHeight||"scroll"==o.css("overflow-y")))M.width=s(q.outerWidth()-f)}else""!==d?M.width=s(d):g==o.width()&&o.height()<q.height()?(M.width=s(g-f),q.outerWidth()>g-f&&(M.width=s(g))):M.width=s(g);g=q.outerWidth();F(E,x);F(function(a){C.push(a.innerHTML);A.push(s(h(a).css("width")))},
x);F(function(a,b){a.style.width=A[b]},y);h(x).height(0);J&&(F(E,w),F(function(a){B.push(s(h(a).css("width")))},w),F(function(a,b){a.style.width=B[b]},t),h(w).height(0));F(function(a,b){a.innerHTML='<div class="dataTables_sizing" style="height:0;overflow:hidden;">'+C[b]+"</div>";a.style.width=A[b]},x);J&&F(function(a,b){a.innerHTML="";a.style.width=B[b]},w);if(q.outerWidth()<g){t=i.scrollHeight>i.offsetHeight||"scroll"==o.css("overflow-y")?g+f:g;if(v&&(i.scrollHeight>i.offsetHeight||"scroll"==o.css("overflow-y")))M.width=
s(t-f);(""===c||""!==d)&&P(a,1,"Possible column misalignment",6)}else t="100%";k.width=s(t);j.width=s(t);J&&(a.nScrollFoot.style.width=s(t));!e&&v&&(k.height=s(da.offsetHeight+f));e&&b.bCollapse&&(k.height=s(e),b=c&&da.offsetWidth>i.offsetWidth?f:0,da.offsetHeight<i.offsetHeight&&(k.height=s(da.offsetHeight+b)));b=q.outerWidth();m[0].style.width=s(b);n.width=s(b);m=q.height()>i.clientHeight||"scroll"==o.css("overflow-y");u="padding"+(u.bScrollbarLeft?"Left":"Right");n[u]=m?f+"px":"0px";J&&(p[0].style.width=
s(b),l[0].style.width=s(b),l[0].style[u]=m?f+"px":"0px");o.scroll();if((a.bSorted||a.bFiltered)&&!a._drawHold)i.scrollTop=0}function F(a,b,c){for(var d=0,e=0,f=b.length,g,j;e<f;){g=b[e].firstChild;for(j=c?c[e].firstChild:null;g;)1===g.nodeType&&(c?a(g,j,d):a(g,d),d++),g=g.nextSibling,j=c?j.nextSibling:null;e++}}function Ca(a){var b=a.nTable,c=a.aoColumns,d=a.oScroll,e=d.sY,f=d.sX,g=d.sXInner,j=c.length,d=X(a,"bVisible"),i=h("th",a.nTHead),n=b.getAttribute("width"),m=b.parentNode,o=!1,k,l;for(k=0;k<
d.length;k++)l=c[d[k]],null!==l.sWidth&&(l.sWidth=Cb(l.sWidthOrig,m),o=!0);if(!o&&!f&&!e&&j==Z(a)&&j==i.length)for(k=0;k<j;k++)c[k].sWidth=s(i.eq(k).width());else{j=h(b).clone().empty().css("visibility","hidden").removeAttr("id").append(h(a.nTHead).clone(!1)).append(h(a.nTFoot).clone(!1)).append(h("<tbody><tr/></tbody>"));j.find("tfoot th, tfoot td").css("width","");var p=j.find("tbody tr"),i=ma(a,j.find("thead")[0]);for(k=0;k<d.length;k++)l=c[d[k]],i[k].style.width=null!==l.sWidthOrig&&""!==l.sWidthOrig?
s(l.sWidthOrig):"";if(a.aoData.length)for(k=0;k<d.length;k++)o=d[k],l=c[o],h(Db(a,o)).clone(!1).append(l.sContentPadding).appendTo(p);j.appendTo(m);f&&g?j.width(g):f?(j.css("width","auto"),j.width()<m.offsetWidth&&j.width(m.offsetWidth)):e?j.width(m.offsetWidth):n&&j.width(n);Eb(a,j[0]);if(f){for(k=g=0;k<d.length;k++)l=c[d[k]],e=h(i[k]).outerWidth(),g+=null===l.sWidthOrig?e:parseInt(l.sWidth,10)+e-h(i[k]).width();j.width(s(g));b.style.width=s(g)}for(k=0;k<d.length;k++)if(l=c[d[k]],e=h(i[k]).width())l.sWidth=
s(e);b.style.width=s(j.css("width"));j.remove()}n&&(b.style.width=s(n));if((n||f)&&!a._reszEvt)h(za).bind("resize.DT-"+a.sInstance,Ma(function(){V(a)})),a._reszEvt=!0}function Ma(a,b){var c=b||200,d,e;return function(){var b=this,g=+new Date,j=arguments;d&&g<d+c?(clearTimeout(e),e=setTimeout(function(){d=l;a.apply(b,j)},c)):d?(d=g,a.apply(b,j)):d=g}}function Cb(a,b){if(!a)return 0;var c=h("<div/>").css("width",s(a)).appendTo(b||O.body),d=c[0].offsetWidth;c.remove();return d}function Eb(a,b){var c=
a.oScroll;if(c.sX||c.sY)c=!c.sX?c.iBarWidth:0,b.style.width=s(h(b).outerWidth()-c)}function Db(a,b){var c=Fb(a,b);if(0>c)return null;var d=a.aoData[c];return!d.nTr?h("<td/>").html(A(a,c,b,"display"))[0]:d.anCells[b]}function Fb(a,b){for(var c,d=-1,e=-1,f=0,g=a.aoData.length;f<g;f++)c=A(a,f,b,"display")+"",c=c.replace(Xb,""),c.length>d&&(d=c.length,e=f);return e}function s(a){return null===a?"0px":"number"==typeof a?0>a?"0px":a+"px":a.match(/\d$/)?a+"px":a}function Gb(){if(!p.__scrollbarWidth){var a=
h("<p/>").css({width:"100%",height:200,padding:0})[0],b=h("<div/>").css({position:"absolute",top:0,left:0,width:200,height:150,padding:0,overflow:"hidden",visibility:"hidden"}).append(a).appendTo("body"),c=a.offsetWidth;b.css("overflow","scroll");a=a.offsetWidth;c===a&&(a=b[0].clientWidth);b.remove();p.__scrollbarWidth=c-a}return p.__scrollbarWidth}function R(a){var b,c,d=[],e=a.aoColumns,f,g,j,i;b=a.aaSortingFixed;c=h.isPlainObject(b);var n=[];f=function(a){a.length&&!h.isArray(a[0])?n.push(a):n.push.apply(n,
a)};h.isArray(b)&&f(b);c&&b.pre&&f(b.pre);f(a.aaSorting);c&&b.post&&f(b.post);for(a=0;a<n.length;a++){i=n[a][0];f=e[i].aDataSort;b=0;for(c=f.length;b<c;b++)g=f[b],j=e[g].sType||"string",d.push({src:i,col:g,dir:n[a][1],index:n[a][2],type:j,formatter:p.ext.type.order[j+"-pre"]})}return d}function kb(a){var b,c,d=[],e=p.ext.type.order,f=a.aoData,g=0,j,i=a.aiDisplayMaster,h;Da(a);h=R(a);b=0;for(c=h.length;b<c;b++)j=h[b],j.formatter&&g++,Hb(a,j.col);if("ssp"!=z(a)&&0!==h.length){b=0;for(c=i.length;b<c;b++)d[i[b]]=
b;g===h.length?i.sort(function(a,b){var c,e,g,j,i=h.length,l=f[a]._aSortData,p=f[b]._aSortData;for(g=0;g<i;g++)if(j=h[g],c=l[j.col],e=p[j.col],c=c<e?-1:c>e?1:0,0!==c)return"asc"===j.dir?c:-c;c=d[a];e=d[b];return c<e?-1:c>e?1:0}):i.sort(function(a,b){var c,g,j,i,l=h.length,p=f[a]._aSortData,r=f[b]._aSortData;for(j=0;j<l;j++)if(i=h[j],c=p[i.col],g=r[i.col],i=e[i.type+"-"+i.dir]||e["string-"+i.dir],c=i(c,g),0!==c)return c;c=d[a];g=d[b];return c<g?-1:c>g?1:0})}a.bSorted=!0}function Ib(a){for(var b,c,
d=a.aoColumns,e=R(a),a=a.oLanguage.oAria,f=0,g=d.length;f<g;f++){c=d[f];var j=c.asSorting;b=c.sTitle.replace(/<.*?>/g,"");var i=c.nTh;i.removeAttribute("aria-sort");c.bSortable&&(0<e.length&&e[0].col==f?(i.setAttribute("aria-sort","asc"==e[0].dir?"ascending":"descending"),c=j[e[0].index+1]||j[0]):c=j[0],b+="asc"===c?a.sSortAscending:a.sSortDescending);i.setAttribute("aria-label",b)}}function Sa(a,b,c,d){var e=a.aaSorting,f=a.aoColumns[b].asSorting,g=function(a){var b=a._idx;b===l&&(b=h.inArray(a[1],
f));return b+1>=f.length?0:b+1};"number"===typeof e[0]&&(e=a.aaSorting=[e]);c&&a.oFeatures.bSortMulti?(c=h.inArray(b,C(e,"0")),-1!==c?(b=g(e[c]),e[c][1]=f[b],e[c]._idx=b):(e.push([b,f[0],0]),e[e.length-1]._idx=0)):e.length&&e[0][0]==b?(b=g(e[0]),e.length=1,e[0][1]=f[b],e[0]._idx=b):(e.length=0,e.push([b,f[0]]),e[0]._idx=0);L(a);"function"==typeof d&&d(a)}function Ka(a,b,c,d){var e=a.aoColumns[c];Ta(b,{},function(b){!1!==e.bSortable&&(a.oFeatures.bProcessing?(B(a,!0),setTimeout(function(){Sa(a,c,b.shiftKey,
d);"ssp"!==z(a)&&B(a,!1)},0)):Sa(a,c,b.shiftKey,d))})}function sa(a){var b=a.aLastSort,c=a.oClasses.sSortColumn,d=R(a),e=a.oFeatures,f,g;if(e.bSort&&e.bSortClasses){e=0;for(f=b.length;e<f;e++)g=b[e].src,h(C(a.aoData,"anCells",g)).removeClass(c+(2>e?e+1:3));e=0;for(f=d.length;e<f;e++)g=d[e].src,h(C(a.aoData,"anCells",g)).addClass(c+(2>e?e+1:3))}a.aLastSort=d}function Hb(a,b){var c=a.aoColumns[b],d=p.ext.order[c.sSortDataType],e;d&&(e=d.call(a.oInstance,a,b,Y(a,b)));for(var f,g=p.ext.type.order[c.sType+
"-pre"],j=0,i=a.aoData.length;j<i;j++)if(c=a.aoData[j],c._aSortData||(c._aSortData=[]),!c._aSortData[b]||d)f=d?e[j]:A(a,j,b,"sort"),c._aSortData[b]=g?g(f):f}function ta(a){if(a.oFeatures.bStateSave&&!a.bDestroying){var b={time:+new Date,start:a._iDisplayStart,length:a._iDisplayLength,order:h.extend(!0,[],a.aaSorting),search:yb(a.oPreviousSearch),columns:h.map(a.aoColumns,function(b,d){return{visible:b.bVisible,search:yb(a.aoPreSearchCols[d])}})};u(a,"aoStateSaveParams","stateSaveParams",[a,b]);a.oSavedState=
b;a.fnStateSaveCallback.call(a.oInstance,a,b)}}function Jb(a){var b,c,d=a.aoColumns;if(a.oFeatures.bStateSave){var e=a.fnStateLoadCallback.call(a.oInstance,a);if(e&&e.time&&(b=u(a,"aoStateLoadParams","stateLoadParams",[a,e]),-1===h.inArray(!1,b)&&(b=a.iStateDuration,!(0<b&&e.time<+new Date-1E3*b)&&d.length===e.columns.length))){a.oLoadedState=h.extend(!0,{},e);a._iDisplayStart=e.start;a.iInitDisplayStart=e.start;a._iDisplayLength=e.length;a.aaSorting=[];h.each(e.order,function(b,c){a.aaSorting.push(c[0]>=
d.length?[0,c[1]]:c)});h.extend(a.oPreviousSearch,zb(e.search));b=0;for(c=e.columns.length;b<c;b++){var f=e.columns[b];d[b].bVisible=f.visible;h.extend(a.aoPreSearchCols[b],zb(f.search))}u(a,"aoStateLoaded","stateLoaded",[a,e])}}}function ua(a){var b=p.settings,a=h.inArray(a,C(b,"nTable"));return-1!==a?b[a]:null}function P(a,b,c,d){c="DataTables warning: "+(null!==a?"table id="+a.sTableId+" - ":"")+c;d&&(c+=". For more information about this error, please see http://datatables.net/tn/"+d);if(b)za.console&&
console.log&&console.log(c);else if(a=p.ext,"alert"==(a.sErrMode||a.errMode))alert(c);else throw Error(c);}function D(a,b,c,d){h.isArray(c)?h.each(c,function(c,d){h.isArray(d)?D(a,b,d[0],d[1]):D(a,b,d)}):(d===l&&(d=c),b[c]!==l&&(a[d]=b[c]))}function Kb(a,b,c){var d,e;for(e in b)b.hasOwnProperty(e)&&(d=b[e],h.isPlainObject(d)?(h.isPlainObject(a[e])||(a[e]={}),h.extend(!0,a[e],d)):a[e]=c&&"data"!==e&&"aaData"!==e&&h.isArray(d)?d.slice():d);return a}function Ta(a,b,c){h(a).bind("click.DT",b,function(b){a.blur();
c(b)}).bind("keypress.DT",b,function(a){13===a.which&&(a.preventDefault(),c(a))}).bind("selectstart.DT",function(){return!1})}function x(a,b,c,d){c&&a[b].push({fn:c,sName:d})}function u(a,b,c,d){var e=[];b&&(e=h.map(a[b].slice().reverse(),function(b){return b.fn.apply(a.oInstance,d)}));null!==c&&h(a.nTable).trigger(c+".dt",d);return e}function Qa(a){var b=a._iDisplayStart,c=a.fnDisplayEnd(),d=a._iDisplayLength;c===a.fnRecordsDisplay()&&(b=c-d);if(-1===d||0>b)b=0;a._iDisplayStart=b}function La(a,b){var c=
a.renderer,d=p.ext.renderer[b];return h.isPlainObject(c)&&c[b]?d[c[b]]||d._:"string"===typeof c?d[c]||d._:d._}function z(a){return a.oFeatures.bServerSide?"ssp":a.ajax||a.sAjaxSource?"ajax":"dom"}function Ua(a,b){var c=[],c=Lb.numbers_length,d=Math.floor(c/2);b<=c?c=S(0,b):a<=d?(c=S(0,c-2),c.push("ellipsis"),c.push(b-1)):(a>=b-1-d?c=S(b-(c-2),b):(c=S(a-1,a+2),c.push("ellipsis"),c.push(b-1)),c.splice(0,0,"ellipsis"),c.splice(0,0,0));c.DT_el="span";return c}function cb(a){h.each({num:function(b){return va(b,
a)},"num-fmt":function(b){return va(b,a,Va)},"html-num":function(b){return va(b,a,wa)},"html-num-fmt":function(b){return va(b,a,wa,Va)}},function(b,c){t.type.order[b+a+"-pre"]=c})}function Mb(a){return function(){var b=[ua(this[p.ext.iApiIndex])].concat(Array.prototype.slice.call(arguments));return p.ext.internal[a].apply(this,b)}}var p,t,q,r,v,Wa={},Nb=/[\r\n]/g,wa=/<.*?>/g,Yb=/^[\w\+\-]/,Zb=/[\w\+\-]$/,Vb=RegExp("(\\/|\\.|\\*|\\+|\\?|\\||\\(|\\)|\\[|\\]|\\{|\\}|\\\\|\\$|\\^|\\-)","g"),Va=/[',$\u00a3\u20ac\u00a5%\u2009\u202F]/g,
H=function(a){return!a||!0===a||"-"===a?!0:!1},Ob=function(a){var b=parseInt(a,10);return!isNaN(b)&&isFinite(a)?b:null},Pb=function(a,b){Wa[b]||(Wa[b]=RegExp(Oa(b),"g"));return"string"===typeof a?a.replace(/\./g,"").replace(Wa[b],"."):a},Xa=function(a,b,c){var d="string"===typeof a;b&&d&&(a=Pb(a,b));c&&d&&(a=a.replace(Va,""));return H(a)||!isNaN(parseFloat(a))&&isFinite(a)},Qb=function(a,b,c){return H(a)?!0:!(H(a)||"string"===typeof a)?null:Xa(a.replace(wa,""),b,c)?!0:null},C=function(a,b,c){var d=
[],e=0,f=a.length;if(c!==l)for(;e<f;e++)a[e]&&a[e][b]&&d.push(a[e][b][c]);else for(;e<f;e++)a[e]&&d.push(a[e][b]);return d},xa=function(a,b,c,d){var e=[],f=0,g=b.length;if(d!==l)for(;f<g;f++)e.push(a[b[f]][c][d]);else for(;f<g;f++)e.push(a[b[f]][c]);return e},S=function(a,b){var c=[],d;b===l?(b=0,d=a):(d=b,b=a);for(var e=b;e<d;e++)c.push(e);return c},Ja=function(a){var b=[],c,d,e=a.length,f,g=0;d=0;a:for(;d<e;d++){c=a[d];for(f=0;f<g;f++)if(b[f]===c)continue a;b.push(c);g++}return b},w=function(a,
b,c){a[b]!==l&&(a[c]=a[b])},$=/\[.*?\]$/,Q=/\(\)$/,qa=h("<div>")[0],Wb=qa.textContent!==l,Xb=/<.*?>/g;p=function(a){this.$=function(a,b){return this.api(!0).$(a,b)};this._=function(a,b){return this.api(!0).rows(a,b).data()};this.api=function(a){return a?new q(ua(this[t.iApiIndex])):new q(this)};this.fnAddData=function(a,b){var c=this.api(!0),d=h.isArray(a)&&(h.isArray(a[0])||h.isPlainObject(a[0]))?c.rows.add(a):c.row.add(a);(b===l||b)&&c.draw();return d.flatten().toArray()};this.fnAdjustColumnSizing=
function(a){var b=this.api(!0).columns.adjust(),c=b.settings()[0],d=c.oScroll;a===l||a?b.draw(!1):(""!==d.sX||""!==d.sY)&&W(c)};this.fnClearTable=function(a){var b=this.api(!0).clear();(a===l||a)&&b.draw()};this.fnClose=function(a){this.api(!0).row(a).child.hide()};this.fnDeleteRow=function(a,b,c){var d=this.api(!0),a=d.rows(a),e=a.settings()[0],h=e.aoData[a[0][0]];a.remove();b&&b.call(this,e,h);(c===l||c)&&d.draw();return h};this.fnDestroy=function(a){this.api(!0).destroy(a)};this.fnDraw=function(a){this.api(!0).draw(!a)};
this.fnFilter=function(a,b,c,d,e,h){e=this.api(!0);null===b||b===l?e.search(a,c,d,h):e.column(b).search(a,c,d,h);e.draw()};this.fnGetData=function(a,b){var c=this.api(!0);if(a!==l){var d=a.nodeName?a.nodeName.toLowerCase():"";return b!==l||"td"==d||"th"==d?c.cell(a,b).data():c.row(a).data()||null}return c.data().toArray()};this.fnGetNodes=function(a){var b=this.api(!0);return a!==l?b.row(a).node():b.rows().nodes().flatten().toArray()};this.fnGetPosition=function(a){var b=this.api(!0),c=a.nodeName.toUpperCase();
return"TR"==c?b.row(a).index():"TD"==c||"TH"==c?(a=b.cell(a).index(),[a.row,a.columnVisible,a.column]):null};this.fnIsOpen=function(a){return this.api(!0).row(a).child.isShown()};this.fnOpen=function(a,b,c){return this.api(!0).row(a).child(b,c).show().child()[0]};this.fnPageChange=function(a,b){var c=this.api(!0).page(a);(b===l||b)&&c.draw(!1)};this.fnSetColumnVis=function(a,b,c){a=this.api(!0).column(a).visible(b);(c===l||c)&&a.columns.adjust().draw()};this.fnSettings=function(){return ua(this[t.iApiIndex])};
this.fnSort=function(a){this.api(!0).order(a).draw()};this.fnSortListener=function(a,b,c){this.api(!0).order.listener(a,b,c)};this.fnUpdate=function(a,b,c,d,e){var h=this.api(!0);c===l||null===c?h.row(b).data(a):h.cell(b,c).data(a);(e===l||e)&&h.columns.adjust();(d===l||d)&&h.draw();return 0};this.fnVersionCheck=t.fnVersionCheck;var b=this,c=a===l,d=this.length;c&&(a={});this.oApi=this.internal=t.internal;for(var e in p.ext.internal)e&&(this[e]=Mb(e));this.each(function(){var e={},g=1<d?Kb(e,a,!0):
a,j=0,i,n=this.getAttribute("id"),e=!1,m=p.defaults;if("table"!=this.nodeName.toLowerCase())P(null,0,"Non-table node initialisation ("+this.nodeName+")",2);else{db(m);eb(m.column);G(m,m,!0);G(m.column,m.column,!0);G(m,g);var o=p.settings,j=0;for(i=o.length;j<i;j++){if(o[j].nTable==this){i=g.bRetrieve!==l?g.bRetrieve:m.bRetrieve;if(c||i)return o[j].oInstance;if(g.bDestroy!==l?g.bDestroy:m.bDestroy){o[j].oInstance.fnDestroy();break}else{P(o[j],0,"Cannot reinitialise DataTable",3);return}}if(o[j].sTableId==
this.id){o.splice(j,1);break}}if(null===n||""===n)this.id=n="DataTables_Table_"+p.ext._unique++;var k=h.extend(!0,{},p.models.oSettings,{nTable:this,oApi:b.internal,oInit:g,sDestroyWidth:h(this)[0].style.width,sInstance:n,sTableId:n});o.push(k);k.oInstance=1===b.length?b:h(this).dataTable();db(g);g.oLanguage&&N(g.oLanguage);g.aLengthMenu&&!g.iDisplayLength&&(g.iDisplayLength=h.isArray(g.aLengthMenu[0])?g.aLengthMenu[0][0]:g.aLengthMenu[0]);g=Kb(h.extend(!0,{},m),g);D(k.oFeatures,g,"bPaginate bLengthChange bFilter bSort bSortMulti bInfo bProcessing bAutoWidth bSortClasses bServerSide bDeferRender".split(" "));
D(k,g,["asStripeClasses","ajax","fnServerData","fnFormatNumber","sServerMethod","aaSorting","aaSortingFixed","aLengthMenu","sPaginationType","sAjaxSource","sAjaxDataProp","iStateDuration","sDom","bSortCellsTop","iTabIndex","fnStateLoadCallback","fnStateSaveCallback","renderer",["iCookieDuration","iStateDuration"],["oSearch","oPreviousSearch"],["aoSearchCols","aoPreSearchCols"],["iDisplayLength","_iDisplayLength"],["bJQueryUI","bJUI"]]);D(k.oScroll,g,[["sScrollX","sX"],["sScrollXInner","sXInner"],
["sScrollY","sY"],["bScrollCollapse","bCollapse"]]);D(k.oLanguage,g,"fnInfoCallback");x(k,"aoDrawCallback",g.fnDrawCallback,"user");x(k,"aoServerParams",g.fnServerParams,"user");x(k,"aoStateSaveParams",g.fnStateSaveParams,"user");x(k,"aoStateLoadParams",g.fnStateLoadParams,"user");x(k,"aoStateLoaded",g.fnStateLoaded,"user");x(k,"aoRowCallback",g.fnRowCallback,"user");x(k,"aoRowCreatedCallback",g.fnCreatedRow,"user");x(k,"aoHeaderCallback",g.fnHeaderCallback,"user");x(k,"aoFooterCallback",g.fnFooterCallback,
"user");x(k,"aoInitComplete",g.fnInitComplete,"user");x(k,"aoPreDrawCallback",g.fnPreDrawCallback,"user");n=k.oClasses;g.bJQueryUI?(h.extend(n,p.ext.oJUIClasses,g.oClasses),g.sDom===m.sDom&&"lfrtip"===m.sDom&&(k.sDom='<"H"lfr>t<"F"ip>'),k.renderer)?h.isPlainObject(k.renderer)&&!k.renderer.header&&(k.renderer.header="jqueryui"):k.renderer="jqueryui":h.extend(n,p.ext.classes,g.oClasses);h(this).addClass(n.sTable);if(""!==k.oScroll.sX||""!==k.oScroll.sY)k.oScroll.iBarWidth=Gb();!0===k.oScroll.sX&&(k.oScroll.sX=
"100%");k.iInitDisplayStart===l&&(k.iInitDisplayStart=g.iDisplayStart,k._iDisplayStart=g.iDisplayStart);null!==g.iDeferLoading&&(k.bDeferLoading=!0,j=h.isArray(g.iDeferLoading),k._iRecordsDisplay=j?g.iDeferLoading[0]:g.iDeferLoading,k._iRecordsTotal=j?g.iDeferLoading[1]:g.iDeferLoading);""!==g.oLanguage.sUrl?(k.oLanguage.sUrl=g.oLanguage.sUrl,h.getJSON(k.oLanguage.sUrl,null,function(a){N(a);G(m.oLanguage,a);h.extend(true,k.oLanguage,g.oLanguage,a);ra(k)}),e=!0):h.extend(!0,k.oLanguage,g.oLanguage);
null===g.asStripeClasses&&(k.asStripeClasses=[n.sStripeOdd,n.sStripeEven]);var j=k.asStripeClasses,r=h("tbody tr:eq(0)",this);-1!==h.inArray(!0,h.map(j,function(a){return r.hasClass(a)}))&&(h("tbody tr",this).removeClass(j.join(" ")),k.asDestroyStripes=j.slice());var o=[],q,j=this.getElementsByTagName("thead");0!==j.length&&(aa(k.aoHeader,j[0]),o=ma(k));if(null===g.aoColumns){q=[];j=0;for(i=o.length;j<i;j++)q.push(null)}else q=g.aoColumns;j=0;for(i=q.length;j<i;j++)Aa(k,o?o[j]:null);hb(k,g.aoColumnDefs,
q,function(a,b){fa(k,a,b)});if(r.length){var s=function(a,b){return a.getAttribute("data-"+b)?b:null};h.each(ia(k,r[0]).cells,function(a,b){var c=k.aoColumns[a];if(c.mData===a){var d=s(b,"sort")||s(b,"order"),e=s(b,"filter")||s(b,"search");if(d!==null||e!==null){c.mData={_:a+".display",sort:d!==null?a+".@data-"+d:l,type:d!==null?a+".@data-"+d:l,filter:e!==null?a+".@data-"+e:l};fa(k,a)}}})}var t=k.oFeatures;g.bStateSave&&(t.bStateSave=!0,Jb(k,g),x(k,"aoDrawCallback",ta,"state_save"));if(g.aaSorting===
l){o=k.aaSorting;j=0;for(i=o.length;j<i;j++)o[j][1]=k.aoColumns[j].asSorting[0]}sa(k);t.bSort&&x(k,"aoDrawCallback",function(){if(k.bSorted){var a=R(k),b={};h.each(a,function(a,c){b[c.src]=c.dir});u(k,null,"order",[k,a,b]);Ib(k)}});x(k,"aoDrawCallback",function(){(k.bSorted||z(k)==="ssp"||t.bDeferRender)&&sa(k)},"sc");fb(k);j=h(this).children("caption").each(function(){this._captionSide=h(this).css("caption-side")});i=h(this).children("thead");0===i.length&&(i=h("<thead/>").appendTo(this));k.nTHead=
i[0];i=h(this).children("tbody");0===i.length&&(i=h("<tbody/>").appendTo(this));k.nTBody=i[0];i=h(this).children("tfoot");if(0===i.length&&0<j.length&&(""!==k.oScroll.sX||""!==k.oScroll.sY))i=h("<tfoot/>").appendTo(this);0===i.length||0===i.children().length?h(this).addClass(n.sNoFooter):0<i.length&&(k.nTFoot=i[0],aa(k.aoFooter,k.nTFoot));if(g.aaData)for(j=0;j<g.aaData.length;j++)I(k,g.aaData[j]);else(k.bDeferLoading||"dom"==z(k))&&ha(k,h(k.nTBody).children("tr"));k.aiDisplay=k.aiDisplayMaster.slice();
k.bInitialised=!0;!1===e&&ra(k)}});b=null;return this};var Rb=[],y=Array.prototype,$b=function(a){var b,c,d=p.settings,e=h.map(d,function(a){return a.nTable});if(a){if(a.nTable&&a.oApi)return[a];if(a.nodeName&&"table"===a.nodeName.toLowerCase())return b=h.inArray(a,e),-1!==b?[d[b]]:null;if(a&&"function"===typeof a.settings)return a.settings().toArray();"string"===typeof a?c=h(a):a instanceof h&&(c=a)}else return[];if(c)return c.map(function(){b=h.inArray(this,e);return-1!==b?d[b]:null}).toArray()};
q=function(a,b){if(!this instanceof q)throw"DT API must be constructed as a new object";var c=[],d=function(a){(a=$b(a))&&c.push.apply(c,a)};if(h.isArray(a))for(var e=0,f=a.length;e<f;e++)d(a[e]);else d(a);this.context=Ja(c);b&&this.push.apply(this,b.toArray?b.toArray():b);this.selector={rows:null,cols:null,opts:null};q.extend(this,this,Rb)};p.Api=q;q.prototype={concat:y.concat,context:[],each:function(a){for(var b=0,c=this.length;b<c;b++)a.call(this,this[b],b,this);return this},eq:function(a){var b=
this.context;return b.length>a?new q(b[a],this[a]):null},filter:function(a){var b=[];if(y.filter)b=y.filter.call(this,a,this);else for(var c=0,d=this.length;c<d;c++)a.call(this,this[c],c,this)&&b.push(this[c]);return new q(this.context,b)},flatten:function(){var a=[];return new q(this.context,a.concat.apply(a,this.toArray()))},join:y.join,indexOf:y.indexOf||function(a,b){for(var c=b||0,d=this.length;c<d;c++)if(this[c]===a)return c;return-1},iterator:function(a,b,c){var d=[],e,f,g,h,i,n=this.context,
m,o,k=this.selector;"string"===typeof a&&(c=b,b=a,a=!1);f=0;for(g=n.length;f<g;f++)if("table"===b)e=c(n[f],f),e!==l&&d.push(e);else if("columns"===b||"rows"===b)e=c(n[f],this[f],f),e!==l&&d.push(e);else if("column"===b||"column-rows"===b||"row"===b||"cell"===b){o=this[f];"column-rows"===b&&(m=Ya(n[f],k.opts));h=0;for(i=o.length;h<i;h++)e=o[h],e="cell"===b?c(n[f],e.row,e.column,f,h):c(n[f],e,f,h,m),e!==l&&d.push(e)}return d.length?(a=new q(n,a?d.concat.apply([],d):d),b=a.selector,b.rows=k.rows,b.cols=
k.cols,b.opts=k.opts,a):this},lastIndexOf:y.lastIndexOf||function(a,b){return this.indexOf.apply(this.toArray.reverse(),arguments)},length:0,map:function(a){var b=[];if(y.map)b=y.map.call(this,a,this);else for(var c=0,d=this.length;c<d;c++)b.push(a.call(this,this[c],c));return new q(this.context,b)},pluck:function(a){return this.map(function(b){return b[a]})},pop:y.pop,push:y.push,reduce:y.reduce||function(a,b){return gb(this,a,b,0,this.length,1)},reduceRight:y.reduceRight||function(a,b){return gb(this,
a,b,this.length-1,-1,-1)},reverse:y.reverse,selector:null,shift:y.shift,sort:y.sort,splice:y.splice,toArray:function(){return y.slice.call(this)},to$:function(){return h(this)},toJQuery:function(){return h(this)},unique:function(){return new q(this.context,Ja(this))},unshift:y.unshift};q.extend=function(a,b,c){if(b&&(b instanceof q||b.__dt_wrapper)){var d,e,f,g=function(a,b,c){return function(){var d=b.apply(a,arguments);q.extend(d,d,c.methodExt);return d}};d=0;for(e=c.length;d<e;d++)f=c[d],b[f.name]=
"function"===typeof f.val?g(a,f.val,f):h.isPlainObject(f.val)?{}:f.val,b[f.name].__dt_wrapper=!0,q.extend(a,b[f.name],f.propExt)}};q.register=r=function(a,b){if(h.isArray(a))for(var c=0,d=a.length;c<d;c++)q.register(a[c],b);else for(var e=a.split("."),f=Rb,g,j,c=0,d=e.length;c<d;c++){g=(j=-1!==e[c].indexOf("()"))?e[c].replace("()",""):e[c];var i;a:{i=0;for(var n=f.length;i<n;i++)if(f[i].name===g){i=f[i];break a}i=null}i||(i={name:g,val:{},methodExt:[],propExt:[]},f.push(i));c===d-1?i.val=b:f=j?i.methodExt:
i.propExt}};q.registerPlural=v=function(a,b,c){q.register(a,c);q.register(b,function(){var a=c.apply(this,arguments);return a===this?this:a instanceof q?a.length?h.isArray(a[0])?new q(a.context,a[0]):a[0]:l:a})};r("tables()",function(a){var b;if(a){b=q;var c=this.context;if("number"===typeof a)a=[c[a]];else var d=h.map(c,function(a){return a.nTable}),a=h(d).filter(a).map(function(){var a=h.inArray(this,d);return c[a]}).toArray();b=new b(a)}else b=this;return b});r("table()",function(a){var a=this.tables(a),
b=a.context;return b.length?new q(b[0]):a});v("tables().nodes()","table().node()",function(){return this.iterator("table",function(a){return a.nTable})});v("tables().body()","table().body()",function(){return this.iterator("table",function(a){return a.nTBody})});v("tables().header()","table().header()",function(){return this.iterator("table",function(a){return a.nTHead})});v("tables().footer()","table().footer()",function(){return this.iterator("table",function(a){return a.nTFoot})});v("tables().containers()",
"table().container()",function(){return this.iterator("table",function(a){return a.nTableWrapper})});r("draw()",function(a){return this.iterator("table",function(b){L(b,!1===a)})});r("page()",function(a){return a===l?this.page.info().page:this.iterator("table",function(b){Ra(b,a)})});r("page.info()",function(){if(0===this.context.length)return l;var a=this.context[0],b=a._iDisplayStart,c=a._iDisplayLength,d=a.fnRecordsDisplay(),e=-1===c;return{page:e?0:Math.floor(b/c),pages:e?1:Math.ceil(d/c),start:b,
end:a.fnDisplayEnd(),length:c,recordsTotal:a.fnRecordsTotal(),recordsDisplay:d}});r("page.len()",function(a){return a===l?0!==this.context.length?this.context[0]._iDisplayLength:l:this.iterator("table",function(b){Pa(b,a)})});var Sb=function(a,b,c){"ssp"==z(a)?L(a,b):(B(a,!0),na(a,[],function(c){ja(a);for(var c=oa(a,c),d=0,g=c.length;d<g;d++)I(a,c[d]);L(a,b);B(a,!1)}));if(c){var d=new q(a);d.one("draw",function(){c(d.ajax.json())})}};r("ajax.json()",function(){var a=this.context;if(0<a.length)return a[0].json});
r("ajax.params()",function(){var a=this.context;if(0<a.length)return a[0].oAjaxData});r("ajax.reload()",function(a,b){return this.iterator("table",function(c){Sb(c,!1===b,a)})});r("ajax.url()",function(a){var b=this.context;if(a===l){if(0===b.length)return l;b=b[0];return b.ajax?h.isPlainObject(b.ajax)?b.ajax.url:b.ajax:b.sAjaxSource}return this.iterator("table",function(b){h.isPlainObject(b.ajax)?b.ajax.url=a:b.ajax=a})});r("ajax.url().load()",function(a,b){return this.iterator("table",function(c){Sb(c,
!1===b,a)})});var Za=function(a,b){var c=[],d,e,f,g,j,i;if(!a||"string"===typeof a||a.length===l)a=[a];f=0;for(g=a.length;f<g;f++){e=a[f]&&a[f].split?a[f].split(","):[a[f]];j=0;for(i=e.length;j<i;j++)(d=b("string"===typeof e[j]?h.trim(e[j]):e[j]))&&d.length&&c.push.apply(c,d)}return c},$a=function(a){a||(a={});a.filter&&!a.search&&(a.search=a.filter);return{search:a.search||"none",order:a.order||"current",page:a.page||"all"}},ab=function(a){for(var b=0,c=a.length;b<c;b++)if(0<a[b].length)return a[0]=
a[b],a.length=1,a.context=[a.context[b]],a;a.length=0;return a},Ya=function(a,b){var c,d,e,f=[],g=a.aiDisplay;c=a.aiDisplayMaster;var j=b.search;d=b.order;e=b.page;if("ssp"==z(a))return"removed"===j?[]:S(0,c.length);if("current"==e){c=a._iDisplayStart;for(d=a.fnDisplayEnd();c<d;c++)f.push(g[c])}else if("current"==d||"applied"==d)f="none"==j?c.slice():"applied"==j?g.slice():h.map(c,function(a){return-1===h.inArray(a,g)?a:null});else if("index"==d||"original"==d){c=0;for(d=a.aoData.length;c<d;c++)"none"==
j?f.push(c):(e=h.inArray(c,g),(-1===e&&"removed"==j||0<=e&&"applied"==j)&&f.push(c))}return f};r("rows()",function(a,b){a===l?a="":h.isPlainObject(a)&&(b=a,a="");var b=$a(b),c=this.iterator("table",function(c){var e=b;return Za(a,function(a){var b=Ob(a);if(b!==null&&!e)return[b];var j=Ya(c,e);if(b!==null&&h.inArray(b,j)!==-1)return[b];if(!a)return j;for(var b=[],i=0,n=j.length;i<n;i++)b.push(c.aoData[j[i]].nTr);return a.nodeName&&h.inArray(a,b)!==-1?[a._DT_RowIndex]:h(b).filter(a).map(function(){return this._DT_RowIndex}).toArray()})});
c.selector.rows=a;c.selector.opts=b;return c});r("rows().nodes()",function(){return this.iterator("row",function(a,b){return a.aoData[b].nTr||l})});r("rows().data()",function(){return this.iterator(!0,"rows",function(a,b){return xa(a.aoData,b,"_aData")})});v("rows().cache()","row().cache()",function(a){return this.iterator("row",function(b,c){var d=b.aoData[c];return"search"===a?d._aFilterData:d._aSortData})});v("rows().invalidate()","row().invalidate()",function(a){return this.iterator("row",function(b,
c){la(b,c,a)})});v("rows().indexes()","row().index()",function(){return this.iterator("row",function(a,b){return b})});v("rows().remove()","row().remove()",function(){var a=this;return this.iterator("row",function(b,c,d){var e=b.aoData;e.splice(c,1);for(var f=0,g=e.length;f<g;f++)null!==e[f].nTr&&(e[f].nTr._DT_RowIndex=f);h.inArray(c,b.aiDisplay);ka(b.aiDisplayMaster,c);ka(b.aiDisplay,c);ka(a[d],c,!1);Qa(b)})});r("rows.add()",function(a){var b=this.iterator("table",function(b){var c,f,g,h=[];f=0;
for(g=a.length;f<g;f++)c=a[f],c.nodeName&&"TR"===c.nodeName.toUpperCase()?h.push(ha(b,c)[0]):h.push(I(b,c));return h}),c=this.rows(-1);c.pop();c.push.apply(c,b.toArray());return c});r("row()",function(a,b){return ab(this.rows(a,b))});r("row().data()",function(a){var b=this.context;if(a===l)return b.length&&this.length?b[0].aoData[this[0]]._aData:l;b[0].aoData[this[0]]._aData=a;la(b[0],this[0],"data");return this});r("row().node()",function(){var a=this.context;return a.length&&this.length?a[0].aoData[this[0]].nTr||
null:null});r("row.add()",function(a){a instanceof h&&a.length&&(a=a[0]);var b=this.iterator("table",function(b){return a.nodeName&&"TR"===a.nodeName.toUpperCase()?ha(b,a)[0]:I(b,a)});return this.row(b[0])});var bb=function(a){var b=a.context;b.length&&a.length&&(a=b[0].aoData[a[0]],a._details&&(a._details.remove(),a._detailsShow=l,a._details=l))},Tb=function(a,b){var c=a.context;if(c.length&&a.length){var d=c[0].aoData[a[0]];if(d._details){(d._detailsShow=b)?d._details.insertAfter(d.nTr):d._details.detach();
var e=c[0],f=new q(e),g=e.aoData;f.off("draw.dt.DT_details column-visibility.dt.DT_details destroy.dt.DT_details");0<C(g,"_details").length&&(f.on("draw.dt.DT_details",function(a,b){e===b&&f.rows({page:"current"}).eq(0).each(function(a){a=g[a];a._detailsShow&&a._details.insertAfter(a.nTr)})}),f.on("column-visibility.dt.DT_details",function(a,b){if(e===b)for(var c,d=Z(b),f=0,h=g.length;f<h;f++)c=g[f],c._details&&c._details.children("td[colspan]").attr("colspan",d)}),f.on("destroy.dt.DT_details",function(a,
b){if(e===b)for(var c=0,d=g.length;c<d;c++)g[c]._details&&bb(g[c])}))}}};r("row().child()",function(a,b){var c=this.context;if(a===l)return c.length&&this.length?c[0].aoData[this[0]]._details:l;if(!0===a)this.child.show();else if(!1===a)bb(this);else if(c.length&&this.length){var d=c[0],c=c[0].aoData[this[0]],e=[],f=function(a,b){if(a.nodeName&&"tr"===a.nodeName.toLowerCase())e.push(a);else{var c=h("<tr><td/></tr>").addClass(b);h("td",c).addClass(b).html(a)[0].colSpan=Z(d);e.push(c[0])}};if(h.isArray(a)||
a instanceof h)for(var g=0,j=a.length;g<j;g++)f(a[g],b);else f(a,b);c._details&&c._details.remove();c._details=h(e);c._detailsShow&&c._details.insertAfter(c.nTr)}return this});r(["row().child.show()","row().child().show()"],function(){Tb(this,!0);return this});r(["row().child.hide()","row().child().hide()"],function(){Tb(this,!1);return this});r(["row().child.remove()","row().child().remove()"],function(){bb(this);return this});r("row().child.isShown()",function(){var a=this.context;return a.length&&
this.length?a[0].aoData[this[0]]._detailsShow||!1:!1});var ac=/^(.+):(name|visIdx|visible)$/;r("columns()",function(a,b){a===l?a="":h.isPlainObject(a)&&(b=a,a="");var b=$a(b),c=this.iterator("table",function(b){var c=a,f=b.aoColumns,g=C(f,"sName"),j=C(f,"nTh");return Za(c,function(a){var c=Ob(a);if(a==="")return S(f.length);if(c!==null)return[c>=0?c:f.length+c];var e=typeof a==="string"?a.match(ac):"";if(e)switch(e[2]){case "visIdx":case "visible":a=parseInt(e[1],10);if(a<0){c=h.map(f,function(a,
b){return a.bVisible?b:null});return[c[c.length+a]]}return[ga(b,a)];case "name":return h.map(g,function(a,b){return a===e[1]?b:null})}else return h(j).filter(a).map(function(){return h.inArray(this,j)}).toArray()})});c.selector.cols=a;c.selector.opts=b;return c});v("columns().header()","column().header()",function(){return this.iterator("column",function(a,b){return a.aoColumns[b].nTh})});v("columns().footer()","column().footer()",function(){return this.iterator("column",function(a,b){return a.aoColumns[b].nTf})});
v("columns().data()","column().data()",function(){return this.iterator("column-rows",function(a,b,c,d,e){for(var c=[],d=0,f=e.length;d<f;d++)c.push(A(a,e[d],b,""));return c})});v("columns().cache()","column().cache()",function(a){return this.iterator("column-rows",function(b,c,d,e,f){return xa(b.aoData,f,"search"===a?"_aFilterData":"_aSortData",c)})});v("columns().nodes()","column().nodes()",function(){return this.iterator("column-rows",function(a,b,c,d,e){return xa(a.aoData,e,"anCells",b)})});v("columns().visible()",
"column().visible()",function(a,b){return this.iterator("column",function(c,d){var e;if(a===l)e=c.aoColumns[d].bVisible;else{var f=c.aoColumns;e=f[d];var g=c.aoData,j,i,n;if(a===l)e=e.bVisible;else{if(e.bVisible!==a){if(a){var m=h.inArray(!0,C(f,"bVisible"),d+1);j=0;for(i=g.length;j<i;j++)n=g[j].nTr,f=g[j].anCells,n&&n.insertBefore(f[d],f[m]||null)}else h(C(c.aoData,"anCells",d)).detach();e.bVisible=a;ba(c,c.aoHeader);ba(c,c.aoFooter);if(b===l||b)V(c),(c.oScroll.sX||c.oScroll.sY)&&W(c);u(c,null,"column-visibility",
[c,d,a]);ta(c)}e=void 0}}return e})});v("columns().indexes()","column().index()",function(a){return this.iterator("column",function(b,c){return"visible"===a?Y(b,c):c})});r("columns.adjust()",function(){return this.iterator("table",function(a){V(a)})});r("column.index()",function(a,b){if(0!==this.context.length){var c=this.context[0];if("fromVisible"===a||"toData"===a)return ga(c,b);if("fromData"===a||"toVisible"===a)return Y(c,b)}});r("column()",function(a,b){return ab(this.columns(a,b))});r("cells()",
function(a,b,c){h.isPlainObject(a)&&(typeof a.row!==l?(c=b,b=null):(c=a,a=null));h.isPlainObject(b)&&(c=b,b=null);if(null===b||b===l)return this.iterator("table",function(b){var d=a,e=$a(c),f=b.aoData,g=Ya(b,e),e=xa(f,g,"anCells"),j=h([].concat.apply([],e)),i,m=b.aoColumns.length,n,p,r,q;return Za(d,function(a){if(a===null||a===l){n=[];p=0;for(r=g.length;p<r;p++){i=g[p];for(q=0;q<m;q++)n.push({row:i,column:q})}return n}return h.isPlainObject(a)?[a]:j.filter(a).map(function(a,b){i=b.parentNode._DT_RowIndex;
return{row:i,column:h.inArray(b,f[i].anCells)}}).toArray()})});var d=this.columns(b,c),e=this.rows(a,c),f,g,j,i,n,m=this.iterator("table",function(a,b){f=[];g=0;for(j=e[b].length;g<j;g++){i=0;for(n=d[b].length;i<n;i++)f.push({row:e[b][g],column:d[b][i]})}return f});h.extend(m.selector,{cols:b,rows:a,opts:c});return m});v("cells().nodes()","cell().node()",function(){return this.iterator("cell",function(a,b,c){return a.aoData[b].anCells[c]})});r("cells().data()",function(){return this.iterator("cell",
function(a,b,c){return A(a,b,c)})});v("cells().cache()","cell().cache()",function(a){a="search"===a?"_aFilterData":"_aSortData";return this.iterator("cell",function(b,c,d){return b.aoData[c][a][d]})});v("cells().indexes()","cell().index()",function(){return this.iterator("cell",function(a,b,c){return{row:b,column:c,columnVisible:Y(a,c)}})});r(["cells().invalidate()","cell().invalidate()"],function(a){var b=this.selector;this.rows(b.rows,b.opts).invalidate(a);return this});r("cell()",function(a,b,
c){return ab(this.cells(a,b,c))});r("cell().data()",function(a){var b=this.context,c=this[0];if(a===l)return b.length&&c.length?A(b[0],c[0].row,c[0].column):l;Ea(b[0],c[0].row,c[0].column,a);la(b[0],c[0].row,"data",c[0].column);return this});r("order()",function(a,b){var c=this.context;if(a===l)return 0!==c.length?c[0].aaSorting:l;"number"===typeof a?a=[[a,b]]:h.isArray(a[0])||(a=Array.prototype.slice.call(arguments));return this.iterator("table",function(b){b.aaSorting=a.slice()})});r("order.listener()",
function(a,b,c){return this.iterator("table",function(d){Ka(d,a,b,c)})});r(["columns().order()","column().order()"],function(a){var b=this;return this.iterator("table",function(c,d){var e=[];h.each(b[d],function(b,c){e.push([c,a])});c.aaSorting=e})});r("search()",function(a,b,c,d){var e=this.context;return a===l?0!==e.length?e[0].oPreviousSearch.sSearch:l:this.iterator("table",function(e){e.oFeatures.bFilter&&ca(e,h.extend({},e.oPreviousSearch,{sSearch:a+"",bRegex:null===b?!1:b,bSmart:null===c?!0:
c,bCaseInsensitive:null===d?!0:d}),1)})});v("columns().search()","column().search()",function(a,b,c,d){return this.iterator("column",function(e,f){var g=e.aoPreSearchCols;if(a===l)return g[f].sSearch;e.oFeatures.bFilter&&(h.extend(g[f],{sSearch:a+"",bRegex:null===b?!1:b,bSmart:null===c?!0:c,bCaseInsensitive:null===d?!0:d}),ca(e,e.oPreviousSearch,1))})});r("state()",function(){return this.context.length?this.context[0].oSavedState:null});r("state.clear()",function(){return this.iterator("table",function(a){a.fnStateSaveCallback.call(a.oInstance,
a,{})})});r("state.loaded()",function(){return this.context.length?this.context[0].oLoadedState:null});r("state.save()",function(){return this.iterator("table",function(a){ta(a)})});p.versionCheck=p.fnVersionCheck=function(a){for(var b=p.version.split("."),a=a.split("."),c,d,e=0,f=a.length;e<f;e++)if(c=parseInt(b[e],10)||0,d=parseInt(a[e],10)||0,c!==d)return c>d;return!0};p.isDataTable=p.fnIsDataTable=function(a){var b=h(a).get(0),c=!1;h.each(p.settings,function(a,e){if(e.nTable===b||e.nScrollHead===
b||e.nScrollFoot===b)c=!0});return c};p.tables=p.fnTables=function(a){return jQuery.map(p.settings,function(b){if(!a||a&&h(b.nTable).is(":visible"))return b.nTable})};p.camelToHungarian=G;r("$()",function(a,b){var c=this.rows(b).nodes(),c=h(c);return h([].concat(c.filter(a).toArray(),c.find(a).toArray()))});h.each(["on","one","off"],function(a,b){r(b+"()",function(){var a=Array.prototype.slice.call(arguments);a[0].match(/\.dt\b/)||(a[0]+=".dt");var d=h(this.tables().nodes());d[b].apply(d,a);return this})});
r("clear()",function(){return this.iterator("table",function(a){ja(a)})});r("settings()",function(){return new q(this.context,this.context)});r("data()",function(){return this.iterator("table",function(a){return C(a.aoData,"_aData")}).flatten()});r("destroy()",function(a){a=a||!1;return this.iterator("table",function(b){var c=b.nTableWrapper.parentNode,d=b.oClasses,e=b.nTable,f=b.nTBody,g=b.nTHead,j=b.nTFoot,i=h(e),f=h(f),l=h(b.nTableWrapper),m=h.map(b.aoData,function(a){return a.nTr}),o;b.bDestroying=
!0;u(b,"aoDestroyCallback","destroy",[b]);a||(new q(b)).columns().visible(!0);l.unbind(".DT").find(":not(tbody *)").unbind(".DT");h(za).unbind(".DT-"+b.sInstance);e!=g.parentNode&&(i.children("thead").detach(),i.append(g));j&&e!=j.parentNode&&(i.children("tfoot").detach(),i.append(j));i.detach();l.detach();b.aaSorting=[];b.aaSortingFixed=[];sa(b);h(m).removeClass(b.asStripeClasses.join(" "));h("th, td",g).removeClass(d.sSortable+" "+d.sSortableAsc+" "+d.sSortableDesc+" "+d.sSortableNone);b.bJUI&&
(h("th span."+d.sSortIcon+", td span."+d.sSortIcon,g).detach(),h("th, td",g).each(function(){var a=h("div."+d.sSortJUIWrapper,this);h(this).append(a.contents());a.detach()}));!a&&c&&c.insertBefore(e,b.nTableReinsertBefore);f.children().detach();f.append(m);i.css("width",b.sDestroyWidth).removeClass(d.sTable);(o=b.asDestroyStripes.length)&&f.children().each(function(a){h(this).addClass(b.asDestroyStripes[a%o])});c=h.inArray(b,p.settings);-1!==c&&p.settings.splice(c,1)})});p.version="1.10.2";p.settings=
[];p.models={};p.models.oSearch={bCaseInsensitive:!0,sSearch:"",bRegex:!1,bSmart:!0};p.models.oRow={nTr:null,anCells:null,_aData:[],_aSortData:null,_aFilterData:null,_sFilterRow:null,_sRowStripe:"",src:null};p.models.oColumn={idx:null,aDataSort:null,asSorting:null,bSearchable:null,bSortable:null,bVisible:null,_sManualType:null,_bAttrSrc:!1,fnCreatedCell:null,fnGetData:null,fnSetData:null,mData:null,mRender:null,nTh:null,nTf:null,sClass:null,sContentPadding:null,sDefaultContent:null,sName:null,sSortDataType:"std",
sSortingClass:null,sSortingClassJUI:null,sTitle:null,sType:null,sWidth:null,sWidthOrig:null};p.defaults={aaData:null,aaSorting:[[0,"asc"]],aaSortingFixed:[],ajax:null,aLengthMenu:[10,25,50,100],aoColumns:null,aoColumnDefs:null,aoSearchCols:[],asStripeClasses:null,bAutoWidth:!0,bDeferRender:!1,bDestroy:!1,bFilter:!0,bInfo:!0,bJQueryUI:!1,bLengthChange:!0,bPaginate:!0,bProcessing:!1,bRetrieve:!1,bScrollCollapse:!1,bServerSide:!1,bSort:!0,bSortMulti:!0,bSortCellsTop:!1,bSortClasses:!0,bStateSave:!1,
fnCreatedRow:null,fnDrawCallback:null,fnFooterCallback:null,fnFormatNumber:function(a){return a.toString().replace(/\B(?=(\d{3})+(?!\d))/g,this.oLanguage.sThousands)},fnHeaderCallback:null,fnInfoCallback:null,fnInitComplete:null,fnPreDrawCallback:null,fnRowCallback:null,fnServerData:null,fnServerParams:null,fnStateLoadCallback:function(a){try{return JSON.parse((-1===a.iStateDuration?sessionStorage:localStorage).getItem("DataTables_"+a.sInstance+"_"+location.pathname))}catch(b){}},fnStateLoadParams:null,
fnStateLoaded:null,fnStateSaveCallback:function(a,b){try{(-1===a.iStateDuration?sessionStorage:localStorage).setItem("DataTables_"+a.sInstance+"_"+location.pathname,JSON.stringify(b))}catch(c){}},fnStateSaveParams:null,iStateDuration:7200,iDeferLoading:null,iDisplayLength:10,iDisplayStart:0,iTabIndex:0,oClasses:{},oLanguage:{oAria:{sSortAscending:": activate to sort column ascending",sSortDescending:": activate to sort column descending"},oPaginate:{sFirst:"First",sLast:"Last",sNext:"Next",sPrevious:"Previous"},
sEmptyTable:"No data available in table",sInfo:"Showing _START_ to _END_ of _TOTAL_ entries",sInfoEmpty:"Showing 0 to 0 of 0 entries",sInfoFiltered:"(filtered from _MAX_ total entries)",sInfoPostFix:"",sDecimal:"",sThousands:",",sLengthMenu:"Show _MENU_ entries",sLoadingRecords:"Loading...",sProcessing:"Processing...",sSearch:"Search:",sSearchPlaceholder:"",sUrl:"",sZeroRecords:"No matching records found"},oSearch:h.extend({},p.models.oSearch),sAjaxDataProp:"data",sAjaxSource:null,sDom:"lfrtip",sPaginationType:"simple_numbers",
sScrollX:"",sScrollXInner:"",sScrollY:"",sServerMethod:"GET",renderer:null};T(p.defaults);p.defaults.column={aDataSort:null,iDataSort:-1,asSorting:["asc","desc"],bSearchable:!0,bSortable:!0,bVisible:!0,fnCreatedCell:null,mData:null,mRender:null,sCellType:"td",sClass:"",sContentPadding:"",sDefaultContent:null,sName:"",sSortDataType:"std",sTitle:null,sType:null,sWidth:null};T(p.defaults.column);p.models.oSettings={oFeatures:{bAutoWidth:null,bDeferRender:null,bFilter:null,bInfo:null,bLengthChange:null,
bPaginate:null,bProcessing:null,bServerSide:null,bSort:null,bSortMulti:null,bSortClasses:null,bStateSave:null},oScroll:{bCollapse:null,iBarWidth:0,sX:null,sXInner:null,sY:null},oLanguage:{fnInfoCallback:null},oBrowser:{bScrollOversize:!1,bScrollbarLeft:!1},ajax:null,aanFeatures:[],aoData:[],aiDisplay:[],aiDisplayMaster:[],aoColumns:[],aoHeader:[],aoFooter:[],oPreviousSearch:{},aoPreSearchCols:[],aaSorting:null,aaSortingFixed:[],asStripeClasses:null,asDestroyStripes:[],sDestroyWidth:0,aoRowCallback:[],
aoHeaderCallback:[],aoFooterCallback:[],aoDrawCallback:[],aoRowCreatedCallback:[],aoPreDrawCallback:[],aoInitComplete:[],aoStateSaveParams:[],aoStateLoadParams:[],aoStateLoaded:[],sTableId:"",nTable:null,nTHead:null,nTFoot:null,nTBody:null,nTableWrapper:null,bDeferLoading:!1,bInitialised:!1,aoOpenRows:[],sDom:null,sPaginationType:"two_button",iStateDuration:0,aoStateSave:[],aoStateLoad:[],oSavedState:null,oLoadedState:null,sAjaxSource:null,sAjaxDataProp:null,bAjaxDataGet:!0,jqXHR:null,json:l,oAjaxData:l,
fnServerData:null,aoServerParams:[],sServerMethod:null,fnFormatNumber:null,aLengthMenu:null,iDraw:0,bDrawing:!1,iDrawError:-1,_iDisplayLength:10,_iDisplayStart:0,_iRecordsTotal:0,_iRecordsDisplay:0,bJUI:null,oClasses:{},bFiltered:!1,bSorted:!1,bSortCellsTop:null,oInit:null,aoDestroyCallback:[],fnRecordsTotal:function(){return"ssp"==z(this)?1*this._iRecordsTotal:this.aiDisplayMaster.length},fnRecordsDisplay:function(){return"ssp"==z(this)?1*this._iRecordsDisplay:this.aiDisplay.length},fnDisplayEnd:function(){var a=
this._iDisplayLength,b=this._iDisplayStart,c=b+a,d=this.aiDisplay.length,e=this.oFeatures,f=e.bPaginate;return e.bServerSide?!1===f||-1===a?b+d:Math.min(b+a,this._iRecordsDisplay):!f||c>d||-1===a?d:c},oInstance:null,sInstance:null,iTabIndex:0,nScrollHead:null,nScrollFoot:null,aLastSort:[],oPlugins:{}};p.ext=t={classes:{},errMode:"alert",feature:[],search:[],internal:{},legacy:{ajax:null},pager:{},renderer:{pageButton:{},header:{}},order:{},type:{detect:[],search:{},order:{}},_unique:0,fnVersionCheck:p.fnVersionCheck,
iApiIndex:0,oJUIClasses:{},sVersion:p.version};h.extend(t,{afnFiltering:t.search,aTypes:t.type.detect,ofnSearch:t.type.search,oSort:t.type.order,afnSortData:t.order,aoFeatures:t.feature,oApi:t.internal,oStdClasses:t.classes,oPagination:t.pager});h.extend(p.ext.classes,{sTable:"dataTable",sNoFooter:"no-footer",sPageButton:"paginate_button",sPageButtonActive:"current",sPageButtonDisabled:"disabled",sStripeOdd:"odd",sStripeEven:"even",sRowEmpty:"dataTables_empty",sWrapper:"dataTables_wrapper",sFilter:"dataTables_filter",
sInfo:"dataTables_info",sPaging:"dataTables_paginate paging_",sLength:"dataTables_length",sProcessing:"dataTables_processing",sSortAsc:"sorting_asc",sSortDesc:"sorting_desc",sSortable:"sorting",sSortableAsc:"sorting_asc_disabled",sSortableDesc:"sorting_desc_disabled",sSortableNone:"sorting_disabled",sSortColumn:"sorting_",sFilterInput:"",sLengthSelect:"",sScrollWrapper:"dataTables_scroll",sScrollHead:"dataTables_scrollHead",sScrollHeadInner:"dataTables_scrollHeadInner",sScrollBody:"dataTables_scrollBody",
sScrollFoot:"dataTables_scrollFoot",sScrollFootInner:"dataTables_scrollFootInner",sHeaderTH:"",sFooterTH:"",sSortJUIAsc:"",sSortJUIDesc:"",sSortJUI:"",sSortJUIAscAllowed:"",sSortJUIDescAllowed:"",sSortJUIWrapper:"",sSortIcon:"",sJUIHeader:"",sJUIFooter:""});var ya="",ya="",E=ya+"ui-state-default",ea=ya+"css_right ui-icon ui-icon-",Ub=ya+"fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix";h.extend(p.ext.oJUIClasses,p.ext.classes,{sPageButton:"fg-button ui-button "+E,sPageButtonActive:"ui-state-disabled",
sPageButtonDisabled:"ui-state-disabled",sPaging:"dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_",sSortAsc:E+" sorting_asc",sSortDesc:E+" sorting_desc",sSortable:E+" sorting",sSortableAsc:E+" sorting_asc_disabled",sSortableDesc:E+" sorting_desc_disabled",sSortableNone:E+" sorting_disabled",sSortJUIAsc:ea+"triangle-1-n",sSortJUIDesc:ea+"triangle-1-s",sSortJUI:ea+"carat-2-n-s",sSortJUIAscAllowed:ea+"carat-1-n",sSortJUIDescAllowed:ea+"carat-1-s",sSortJUIWrapper:"DataTables_sort_wrapper",
sSortIcon:"DataTables_sort_icon",sScrollHead:"dataTables_scrollHead "+E,sScrollFoot:"dataTables_scrollFoot "+E,sHeaderTH:E,sFooterTH:E,sJUIHeader:Ub+" ui-corner-tl ui-corner-tr",sJUIFooter:Ub+" ui-corner-bl ui-corner-br"});var Lb=p.ext.pager;h.extend(Lb,{simple:function(){return["previous","next"]},full:function(){return["first","previous","next","last"]},simple_numbers:function(a,b){return["previous",Ua(a,b),"next"]},full_numbers:function(a,b){return["first","previous",Ua(a,b),"next","last"]},_numbers:Ua,
numbers_length:7});h.extend(!0,p.ext.renderer,{pageButton:{_:function(a,b,c,d,e,f){var g=a.oClasses,j=a.oLanguage.oPaginate,i,l,m=0,o=function(b,d){var k,p,r,q,s=function(b){Ra(a,b.data.action,true)};k=0;for(p=d.length;k<p;k++){q=d[k];if(h.isArray(q)){r=h("<"+(q.DT_el||"div")+"/>").appendTo(b);o(r,q)}else{l=i="";switch(q){case "ellipsis":b.append("<span>&hellip;</span>");break;case "first":i=j.sFirst;l=q+(e>0?"":" "+g.sPageButtonDisabled);break;case "previous":i=j.sPrevious;l=q+(e>0?"":" "+g.sPageButtonDisabled);
break;case "next":i=j.sNext;l=q+(e<f-1?"":" "+g.sPageButtonDisabled);break;case "last":i=j.sLast;l=q+(e<f-1?"":" "+g.sPageButtonDisabled);break;default:i=q+1;l=e===q?g.sPageButtonActive:""}if(i){r=h("<a>",{"class":g.sPageButton+" "+l,"aria-controls":a.sTableId,"data-dt-idx":m,tabindex:a.iTabIndex,id:c===0&&typeof q==="string"?a.sTableId+"_"+q:null}).html(i).appendTo(b);Ta(r,{action:q},s);m++}}}};try{var k=h(O.activeElement).data("dt-idx");o(h(b).empty(),d);k!==null&&h(b).find("[data-dt-idx="+k+"]").focus()}catch(p){}}}});
var va=function(a,b,c,d){if(!a||"-"===a)return-Infinity;b&&(a=Pb(a,b));a.replace&&(c&&(a=a.replace(c,"")),d&&(a=a.replace(d,"")));return 1*a};h.extend(t.type.order,{"date-pre":function(a){return Date.parse(a)||0},"html-pre":function(a){return H(a)?"":a.replace?a.replace(/<.*?>/g,"").toLowerCase():a+""},"string-pre":function(a){return H(a)?"":"string"===typeof a?a.toLowerCase():!a.toString?"":a.toString()},"string-asc":function(a,b){return a<b?-1:a>b?1:0},"string-desc":function(a,b){return a<b?1:a>
b?-1:0}});cb("");h.extend(p.ext.type.detect,[function(a,b){var c=b.oLanguage.sDecimal;return Xa(a,c)?"num"+c:null},function(a){if(a&&(!Yb.test(a)||!Zb.test(a)))return null;var b=Date.parse(a);return null!==b&&!isNaN(b)||H(a)?"date":null},function(a,b){var c=b.oLanguage.sDecimal;return Xa(a,c,!0)?"num-fmt"+c:null},function(a,b){var c=b.oLanguage.sDecimal;return Qb(a,c)?"html-num"+c:null},function(a,b){var c=b.oLanguage.sDecimal;return Qb(a,c,!0)?"html-num-fmt"+c:null},function(a){return H(a)||"string"===
typeof a&&-1!==a.indexOf("<")?"html":null}]);h.extend(p.ext.type.search,{html:function(a){return H(a)?a:"string"===typeof a?a.replace(Nb," ").replace(wa,""):""},string:function(a){return H(a)?a:"string"===typeof a?a.replace(Nb," "):a}});h.extend(!0,p.ext.renderer,{header:{_:function(a,b,c,d){h(a.nTable).on("order.dt.DT",function(e,f,g,h){if(a===f){e=c.idx;b.removeClass(c.sSortingClass+" "+d.sSortAsc+" "+d.sSortDesc).addClass(h[e]=="asc"?d.sSortAsc:h[e]=="desc"?d.sSortDesc:c.sSortingClass)}})},jqueryui:function(a,
b,c,d){var e=c.idx;h("<div/>").addClass(d.sSortJUIWrapper).append(b.contents()).append(h("<span/>").addClass(d.sSortIcon+" "+c.sSortingClassJUI)).appendTo(b);h(a.nTable).on("order.dt.DT",function(f,g,h,i){if(a===g){b.removeClass(d.sSortAsc+" "+d.sSortDesc).addClass(i[e]=="asc"?d.sSortAsc:i[e]=="desc"?d.sSortDesc:c.sSortingClass);b.find("span."+d.sSortIcon).removeClass(d.sSortJUIAsc+" "+d.sSortJUIDesc+" "+d.sSortJUI+" "+d.sSortJUIAscAllowed+" "+d.sSortJUIDescAllowed).addClass(i[e]=="asc"?d.sSortJUIAsc:
i[e]=="desc"?d.sSortJUIDesc:c.sSortingClassJUI)}})}}});p.render={number:function(a,b,c,d){return{display:function(e){var f=0>e?"-":"",e=Math.abs(parseFloat(e)),g=parseInt(e,10),e=c?b+(e-g).toFixed(c).substring(2):"";return f+(d||"")+g.toString().replace(/\B(?=(\d{3})+(?!\d))/g,a)+e}}}};h.extend(p.ext.internal,{_fnExternApiFunc:Mb,_fnBuildAjax:na,_fnAjaxUpdate:jb,_fnAjaxParameters:sb,_fnAjaxUpdateDraw:tb,_fnAjaxDataSrc:oa,_fnAddColumn:Aa,_fnColumnOptions:fa,_fnAdjustColumnSizing:V,_fnVisibleToColumnIndex:ga,
_fnColumnIndexToVisible:Y,_fnVisbleColumns:Z,_fnGetColumns:X,_fnColumnTypes:Da,_fnApplyColumnDefs:hb,_fnHungarianMap:T,_fnCamelToHungarian:G,_fnLanguageCompat:N,_fnBrowserDetect:fb,_fnAddData:I,_fnAddTr:ha,_fnNodeToDataIndex:function(a,b){return b._DT_RowIndex!==l?b._DT_RowIndex:null},_fnNodeToColumnIndex:function(a,b,c){return h.inArray(c,a.aoData[b].anCells)},_fnGetCellData:A,_fnSetCellData:Ea,_fnSplitObjNotation:Ga,_fnGetObjectDataFn:U,_fnSetObjectDataFn:Ba,_fnGetDataMaster:Ha,_fnClearTable:ja,
_fnDeleteIndex:ka,_fnInvalidateRow:la,_fnGetRowElements:ia,_fnCreateTr:Fa,_fnBuildHead:ib,_fnDrawHead:ba,_fnDraw:K,_fnReDraw:L,_fnAddOptionsHtml:lb,_fnDetectHeader:aa,_fnGetUniqueThs:ma,_fnFeatureHtmlFilter:nb,_fnFilterComplete:ca,_fnFilterCustom:wb,_fnFilterColumn:vb,_fnFilter:ub,_fnFilterCreateSearch:Na,_fnEscapeRegex:Oa,_fnFilterData:xb,_fnFeatureHtmlInfo:qb,_fnUpdateInfo:Ab,_fnInfoMacros:Bb,_fnInitialise:ra,_fnInitComplete:pa,_fnLengthChange:Pa,_fnFeatureHtmlLength:mb,_fnFeatureHtmlPaginate:rb,
_fnPageChange:Ra,_fnFeatureHtmlProcessing:ob,_fnProcessingDisplay:B,_fnFeatureHtmlTable:pb,_fnScrollDraw:W,_fnApplyToChildren:F,_fnCalculateColumnWidths:Ca,_fnThrottle:Ma,_fnConvertToWidth:Cb,_fnScrollingWidthAdjust:Eb,_fnGetWidestNode:Db,_fnGetMaxLenString:Fb,_fnStringToCss:s,_fnScrollBarWidth:Gb,_fnSortFlatten:R,_fnSort:kb,_fnSortAria:Ib,_fnSortListener:Sa,_fnSortAttachListener:Ka,_fnSortingClasses:sa,_fnSortData:Hb,_fnSaveState:ta,_fnLoadState:Jb,_fnSettingsFromNode:ua,_fnLog:P,_fnMap:D,_fnBindAction:Ta,
_fnCallbackReg:x,_fnCallbackFire:u,_fnLengthOverflow:Qa,_fnRenderer:La,_fnDataSource:z,_fnRowAttributes:Ia,_fnCalculateEnd:function(){}});h.fn.dataTable=p;h.fn.dataTableSettings=p.settings;h.fn.dataTableExt=p.ext;h.fn.DataTable=function(a){return h(this).dataTable(a).api()};h.each(p,function(a,b){h.fn.DataTable[a]=b});return h.fn.dataTable};"function"===typeof define&&define.amd?define("datatables",["jquery"],N):"object"===typeof exports?N(require("jquery")):jQuery&&!jQuery.fn.dataTable&&N(jQuery)})(window,
document);

/*!
 TableTools 2.2.2
 2009-2014 SpryMedia Ltd - datatables.net/license

 ZeroClipboard 1.0.4
 Author: Joseph Huckaby - MIT licensed
*/
var TableTools;
(function(m,k,p){var r=function(n){var g={version:"1.0.4-TableTools2",clients:{},moviePath:"",nextId:1,$:function(a){"string"==typeof a&&(a=k.getElementById(a));a.addClass||(a.hide=function(){this.style.display="none"},a.show=function(){this.style.display=""},a.addClass=function(a){this.removeClass(a);this.className+=" "+a},a.removeClass=function(a){this.className=this.className.replace(RegExp("\\s*"+a+"\\s*")," ").replace(/^\s+/,"").replace(/\s+$/,"")},a.hasClass=function(a){return!!this.className.match(RegExp("\\s*"+a+
"\\s*"))});return a},setMoviePath:function(a){this.moviePath=a},dispatch:function(a,b,c){(a=this.clients[a])&&a.receiveEvent(b,c)},register:function(a,b){this.clients[a]=b},getDOMObjectPosition:function(a){var b={left:0,top:0,width:a.width?a.width:a.offsetWidth,height:a.height?a.height:a.offsetHeight};""!==a.style.width&&(b.width=a.style.width.replace("px",""));""!==a.style.height&&(b.height=a.style.height.replace("px",""));for(;a;)b.left+=a.offsetLeft,b.top+=a.offsetTop,a=a.offsetParent;return b},
Client:function(a){this.handlers={};this.id=g.nextId++;this.movieId="ZeroClipboard_TableToolsMovie_"+this.id;g.register(this.id,this);a&&this.glue(a)}};g.Client.prototype={id:0,ready:!1,movie:null,clipText:"",fileName:"",action:"copy",handCursorEnabled:!0,cssEffects:!0,handlers:null,sized:!1,glue:function(a,b){this.domElement=g.$(a);var c=99;this.domElement.style.zIndex&&(c=parseInt(this.domElement.style.zIndex,10)+1);var d=g.getDOMObjectPosition(this.domElement);this.div=k.createElement("div");var e=
this.div.style;e.position="absolute";e.left="0px";e.top="0px";e.width=d.width+"px";e.height=d.height+"px";e.zIndex=c;"undefined"!=typeof b&&""!==b&&(this.div.title=b);0!==d.width&&0!==d.height&&(this.sized=!0);this.domElement&&(this.domElement.appendChild(this.div),this.div.innerHTML=this.getHTML(d.width,d.height).replace(/&/g,"&amp;"))},positionElement:function(){var a=g.getDOMObjectPosition(this.domElement),b=this.div.style;b.position="absolute";b.width=a.width+"px";b.height=a.height+"px";0!==a.width&&
0!==a.height&&(this.sized=!0,b=this.div.childNodes[0],b.width=a.width,b.height=a.height)},getHTML:function(a,b){var c="",d="id="+this.id+"&width="+a+"&height="+b;if(navigator.userAgent.match(/MSIE/))var e=location.href.match(/^https/i)?"https://":"http://",c=c+('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="'+e+'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="'+a+'" height="'+b+'" id="'+this.movieId+'" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="'+
g.moviePath+'" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="'+d+'"/><param name="wmode" value="transparent"/></object>');else c+='<embed id="'+this.movieId+'" src="'+g.moviePath+'" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="'+a+'" height="'+b+'" name="'+this.movieId+'" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="'+
d+'" wmode="transparent" />';return c},hide:function(){this.div&&(this.div.style.left="-2000px")},show:function(){this.reposition()},destroy:function(){if(this.domElement&&this.div){this.hide();this.div.innerHTML="";var a=k.getElementsByTagName("body")[0];try{a.removeChild(this.div)}catch(b){}this.div=this.domElement=null}},reposition:function(a){a&&((this.domElement=g.$(a))||this.hide());if(this.domElement&&this.div){var a=g.getDOMObjectPosition(this.domElement),b=this.div.style;b.left=""+a.left+
"px";b.top=""+a.top+"px"}},clearText:function(){this.clipText="";this.ready&&this.movie.clearText()},appendText:function(a){this.clipText+=a;this.ready&&this.movie.appendText(a)},setText:function(a){this.clipText=a;this.ready&&this.movie.setText(a)},setCharSet:function(a){this.charSet=a;this.ready&&this.movie.setCharSet(a)},setBomInc:function(a){this.incBom=a;this.ready&&this.movie.setBomInc(a)},setFileName:function(a){this.fileName=a;this.ready&&this.movie.setFileName(a)},setAction:function(a){this.action=
a;this.ready&&this.movie.setAction(a)},addEventListener:function(a,b){a=a.toString().toLowerCase().replace(/^on/,"");this.handlers[a]||(this.handlers[a]=[]);this.handlers[a].push(b)},setHandCursor:function(a){this.handCursorEnabled=a;this.ready&&this.movie.setHandCursor(a)},setCSSEffects:function(a){this.cssEffects=!!a},receiveEvent:function(a,b){var c,a=a.toString().toLowerCase().replace(/^on/,"");switch(a){case "load":this.movie=k.getElementById(this.movieId);if(!this.movie){c=this;setTimeout(function(){c.receiveEvent("load",
null)},1);return}if(!this.ready&&navigator.userAgent.match(/Firefox/)&&navigator.userAgent.match(/Windows/)){c=this;setTimeout(function(){c.receiveEvent("load",null)},100);this.ready=!0;return}this.ready=!0;this.movie.clearText();this.movie.appendText(this.clipText);this.movie.setFileName(this.fileName);this.movie.setAction(this.action);this.movie.setCharSet(this.charSet);this.movie.setBomInc(this.incBom);this.movie.setHandCursor(this.handCursorEnabled);break;case "mouseover":this.domElement&&this.cssEffects&&
this.recoverActive&&this.domElement.addClass("active");break;case "mouseout":this.domElement&&this.cssEffects&&(this.recoverActive=!1,this.domElement.hasClass("active")&&(this.domElement.removeClass("active"),this.recoverActive=!0));break;case "mousedown":this.domElement&&this.cssEffects&&this.domElement.addClass("active");break;case "mouseup":this.domElement&&this.cssEffects&&(this.domElement.removeClass("active"),this.recoverActive=!1)}if(this.handlers[a])for(var d=0,e=this.handlers[a].length;d<
e;d++){var f=this.handlers[a][d];if("function"==typeof f)f(this,b);else if("object"==typeof f&&2==f.length)f[0][f[1]](this,b);else if("string"==typeof f)m[f](this,b)}}};m.ZeroClipboard_TableTools=g;var f=jQuery;TableTools=function(a,b){!this instanceof TableTools&&alert("Warning: TableTools must be initialised with the keyword 'new'");this.s={that:this,dt:f.fn.dataTable.Api?(new f.fn.dataTable.Api(a)).settings()[0]:a.fnSettings(),print:{saveStart:-1,saveLength:-1,saveScroll:-1,funcEnd:function(){}},
buttonCounter:0,select:{type:"",selected:[],preRowSelect:null,postSelected:null,postDeselected:null,all:!1,selectedClass:""},custom:{},swfPath:"",buttonSet:[],master:!1,tags:{}};this.dom={container:null,table:null,print:{hidden:[],message:null},collection:{collection:null,background:null}};this.classes=f.extend(!0,{},TableTools.classes);this.s.dt.bJUI&&f.extend(!0,this.classes,TableTools.classes_themeroller);this.fnSettings=function(){return this.s};"undefined"==typeof b&&(b={});TableTools._aInstances.push(this);
this._fnConstruct(b);return this};TableTools.prototype={fnGetSelected:function(a){var b=[],c=this.s.dt.aoData,d=this.s.dt.aiDisplay,e;if(a){a=0;for(e=d.length;a<e;a++)c[d[a]]._DTTT_selected&&b.push(c[d[a]].nTr)}else{a=0;for(e=c.length;a<e;a++)c[a]._DTTT_selected&&b.push(c[a].nTr)}return b},fnGetSelectedData:function(){var a=[],b=this.s.dt.aoData,c,d;c=0;for(d=b.length;c<d;c++)b[c]._DTTT_selected&&a.push(this.s.dt.oInstance.fnGetData(c));return a},fnGetSelectedIndexes:function(a){var b=[],c=this.s.dt.aoData,
d=this.s.dt.aiDisplay,e;if(a){a=0;for(e=d.length;a<e;a++)c[d[a]]._DTTT_selected&&b.push(d[a])}else{a=0;for(e=c.length;a<e;a++)c[a]._DTTT_selected&&b.push(a)}return b},fnIsSelected:function(a){a=this.s.dt.oInstance.fnGetPosition(a);return!0===this.s.dt.aoData[a]._DTTT_selected?!0:!1},fnSelectAll:function(a){this._fnRowSelect(a?this.s.dt.aiDisplay:this.s.dt.aoData)},fnSelectNone:function(a){this._fnRowDeselect(this.fnGetSelectedIndexes(a))},fnSelect:function(a){"single"==this.s.select.type&&this.fnSelectNone();
this._fnRowSelect(a)},fnDeselect:function(a){this._fnRowDeselect(a)},fnGetTitle:function(a){var b="";"undefined"!=typeof a.sTitle&&""!==a.sTitle?b=a.sTitle:(a=k.getElementsByTagName("title"),0<a.length&&(b=a[0].innerHTML));return 4>"¡".toString().length?b.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,""):b.replace(/[^a-zA-Z0-9_\.,\-_ !\(\)]/g,"")},fnCalcColRatios:function(a){var b=this.s.dt.aoColumns,a=this._fnColumnTargets(a.mColumns),c=[],d=0,e=0,f,i;f=0;for(i=a.length;f<i;f++)a[f]&&(d=b[f].nTh.offsetWidth,
e+=d,c.push(d));f=0;for(i=c.length;f<i;f++)c[f]/=e;return c.join("\t")},fnGetTableData:function(a){if(this.s.dt)return this._fnGetDataTablesData(a)},fnSetText:function(a,b){this._fnFlashSetText(a,b)},fnResizeButtons:function(){for(var a in g.clients)if(a){var b=g.clients[a];"undefined"!=typeof b.domElement&&b.domElement.parentNode&&b.positionElement()}},fnResizeRequired:function(){for(var a in g.clients)if(a){var b=g.clients[a];if("undefined"!=typeof b.domElement&&b.domElement.parentNode==this.dom.container&&
!1===b.sized)return!0}return!1},fnPrint:function(a,b){b===p&&(b={});a===p||a?this._fnPrintStart(b):this._fnPrintEnd()},fnInfo:function(a,b){var c=f("<div/>").addClass(this.classes.print.info).html(a).appendTo("body");setTimeout(function(){c.fadeOut("normal",function(){c.remove()})},b)},fnContainer:function(){return this.dom.container},_fnConstruct:function(a){var b=this;this._fnCustomiseSettings(a);this.dom.container=k.createElement(this.s.tags.container);this.dom.container.className=this.classes.container;
"none"!=this.s.select.type&&this._fnRowSelectConfig();this._fnButtonDefinations(this.s.buttonSet,this.dom.container);this.s.dt.aoDestroyCallback.push({sName:"TableTools",fn:function(){f(b.s.dt.nTBody).off("click.DTTT_Select","tr");f(b.dom.container).empty();var a=f.inArray(b,TableTools._aInstances);-1!==a&&TableTools._aInstances.splice(a,1)}})},_fnCustomiseSettings:function(a){"undefined"==typeof this.s.dt._TableToolsInit&&(this.s.master=!0,this.s.dt._TableToolsInit=!0);this.dom.table=this.s.dt.nTable;
this.s.custom=f.extend({},TableTools.DEFAULTS,a);this.s.swfPath=this.s.custom.sSwfPath;"undefined"!=typeof g&&(g.moviePath=this.s.swfPath);this.s.select.type=this.s.custom.sRowSelect;this.s.select.preRowSelect=this.s.custom.fnPreRowSelect;this.s.select.postSelected=this.s.custom.fnRowSelected;this.s.select.postDeselected=this.s.custom.fnRowDeselected;this.s.custom.sSelectedClass&&(this.classes.select.row=this.s.custom.sSelectedClass);this.s.tags=this.s.custom.oTags;this.s.buttonSet=this.s.custom.aButtons},
_fnButtonDefinations:function(a,b){for(var c,d=0,e=a.length;d<e;d++){if("string"==typeof a[d]){if("undefined"==typeof TableTools.BUTTONS[a[d]]){alert("TableTools: Warning - unknown button type: "+a[d]);continue}c=f.extend({},TableTools.BUTTONS[a[d]],!0)}else{if("undefined"==typeof TableTools.BUTTONS[a[d].sExtends]){alert("TableTools: Warning - unknown button type: "+a[d].sExtends);continue}c=f.extend({},TableTools.BUTTONS[a[d].sExtends],!0);c=f.extend(c,a[d],!0)}(c=this._fnCreateButton(c,f(b).hasClass(this.classes.collection.container)))&&
b.appendChild(c)}},_fnCreateButton:function(a,b){var c=this._fnButtonBase(a,b);if(a.sAction.match(/flash/)){if(!this._fnHasFlash())return!1;this._fnFlashConfig(c,a)}else"text"==a.sAction?this._fnTextConfig(c,a):"div"==a.sAction?this._fnTextConfig(c,a):"collection"==a.sAction&&(this._fnTextConfig(c,a),this._fnCollectionConfig(c,a));return c},_fnButtonBase:function(a,b){var c,d,e;b?(c=a.sTag&&"default"!==a.sTag?a.sTag:this.s.tags.collection.button,d=a.sLinerTag&&"default"!==a.sLinerTag?a.sLiner:this.s.tags.collection.liner,
e=this.classes.collection.buttons.normal):(c=a.sTag&&"default"!==a.sTag?a.sTag:this.s.tags.button,d=a.sLinerTag&&"default"!==a.sLinerTag?a.sLiner:this.s.tags.liner,e=this.classes.buttons.normal);c=k.createElement(c);d=k.createElement(d);var f=this._fnGetMasterSettings();c.className=e+" "+a.sButtonClass;c.setAttribute("id","ToolTables_"+this.s.dt.sInstance+"_"+f.buttonCounter);c.appendChild(d);d.innerHTML=a.sButtonText;f.buttonCounter++;return c},_fnGetMasterSettings:function(){if(this.s.master)return this.s;
for(var a=TableTools._aInstances,b=0,c=a.length;b<c;b++)if(this.dom.table==a[b].s.dt.nTable)return a[b].s},_fnCollectionConfig:function(a,b){var c=k.createElement(this.s.tags.collection.container);c.style.display="none";c.className=this.classes.collection.container;b._collection=c;k.body.appendChild(c);this._fnButtonDefinations(b.aButtons,c)},_fnCollectionShow:function(a,b){var c=this,d=f(a).offset(),e=b._collection,j=d.left,d=d.top+f(a).outerHeight(),i=f(m).height(),h=f(k).height(),o=f(m).width(),
g=f(k).width();e.style.position="absolute";e.style.left=j+"px";e.style.top=d+"px";e.style.display="block";f(e).css("opacity",0);var l=k.createElement("div");l.style.position="absolute";l.style.left="0px";l.style.top="0px";l.style.height=(i>h?i:h)+"px";l.style.width=(o>g?o:g)+"px";l.className=this.classes.collection.background;f(l).css("opacity",0);k.body.appendChild(l);k.body.appendChild(e);i=f(e).outerWidth();o=f(e).outerHeight();j+i>g&&(e.style.left=g-i+"px");d+o>h&&(e.style.top=d-o-f(a).outerHeight()+
"px");this.dom.collection.collection=e;this.dom.collection.background=l;setTimeout(function(){f(e).animate({opacity:1},500);f(l).animate({opacity:0.25},500)},10);this.fnResizeButtons();f(l).click(function(){c._fnCollectionHide.call(c,null,null)})},_fnCollectionHide:function(a,b){!(null!==b&&"collection"==b.sExtends)&&null!==this.dom.collection.collection&&(f(this.dom.collection.collection).animate({opacity:0},500,function(){this.style.display="none"}),f(this.dom.collection.background).animate({opacity:0},
500,function(){this.parentNode.removeChild(this)}),this.dom.collection.collection=null,this.dom.collection.background=null)},_fnRowSelectConfig:function(){if(this.s.master){var a=this,b=this.s.dt;f(b.nTable).addClass(this.classes.select.table);"os"===this.s.select.type&&(f(b.nTBody).on("mousedown.DTTT_Select","tr",function(a){if(a.shiftKey)f(b.nTBody).css("-moz-user-select","none").one("selectstart.DTTT_Select","tr",function(){return!1})}),f(b.nTBody).on("mouseup.DTTT_Select","tr",function(){f(b.nTBody).css("-moz-user-select",
"")}));f(b.nTBody).on("click.DTTT_Select",this.s.custom.sRowSelector,function(c){var d=this.nodeName.toLowerCase()==="tr"?this:f(this).parents("tr")[0],e=a.s.select,j=a.s.dt.oInstance.fnGetPosition(d);if(d.parentNode==b.nTBody&&b.oInstance.fnGetData(d)!==null){if(e.type=="os")if(c.ctrlKey||c.metaKey)a.fnIsSelected(d)?a._fnRowDeselect(d,c):a._fnRowSelect(d,c);else if(c.shiftKey){var i=a.s.dt.aiDisplay.slice(),h=f.inArray(e.lastRow,i),o=f.inArray(j,i);if(a.fnGetSelected().length===0||h===-1)i.splice(f.inArray(j,
i)+1,i.length);else{if(h>o)var g=o,o=h,h=g;i.splice(o+1,i.length);i.splice(0,h)}if(a.fnIsSelected(d)){i.splice(f.inArray(j,i),1);a._fnRowDeselect(i,c)}else a._fnRowSelect(i,c)}else if(a.fnIsSelected(d)&&a.fnGetSelected().length===1)a._fnRowDeselect(d,c);else{a.fnSelectNone();a._fnRowSelect(d,c)}else if(a.fnIsSelected(d))a._fnRowDeselect(d,c);else if(e.type=="single"){a.fnSelectNone();a._fnRowSelect(d,c)}else e.type=="multi"&&a._fnRowSelect(d,c);e.lastRow=j}});b.oApi._fnCallbackReg(b,"aoRowCreatedCallback",
function(c,d,e){b.aoData[e]._DTTT_selected&&f(c).addClass(a.classes.select.row)},"TableTools-SelectAll")}},_fnRowSelect:function(a,b){var c=this._fnSelectData(a),d=[],e,j;e=0;for(j=c.length;e<j;e++)c[e].nTr&&d.push(c[e].nTr);if(null===this.s.select.preRowSelect||this.s.select.preRowSelect.call(this,b,d,!0)){e=0;for(j=c.length;e<j;e++)c[e]._DTTT_selected=!0,c[e].nTr&&f(c[e].nTr).addClass(this.classes.select.row);null!==this.s.select.postSelected&&this.s.select.postSelected.call(this,d);TableTools._fnEventDispatch(this,
"select",d,!0)}},_fnRowDeselect:function(a,b){var c=this._fnSelectData(a),d=[],e,j;e=0;for(j=c.length;e<j;e++)c[e].nTr&&d.push(c[e].nTr);if(null===this.s.select.preRowSelect||this.s.select.preRowSelect.call(this,b,d,!1)){e=0;for(j=c.length;e<j;e++)c[e]._DTTT_selected=!1,c[e].nTr&&f(c[e].nTr).removeClass(this.classes.select.row);null!==this.s.select.postDeselected&&this.s.select.postDeselected.call(this,d);TableTools._fnEventDispatch(this,"select",d,!1)}},_fnSelectData:function(a){var b=[],c,d,e;if(a.nodeName)c=
this.s.dt.oInstance.fnGetPosition(a),b.push(this.s.dt.aoData[c]);else if("undefined"!==typeof a.length){d=0;for(e=a.length;d<e;d++)a[d].nodeName?(c=this.s.dt.oInstance.fnGetPosition(a[d]),b.push(this.s.dt.aoData[c])):"number"===typeof a[d]?b.push(this.s.dt.aoData[a[d]]):b.push(a[d])}else b.push(a);return b},_fnTextConfig:function(a,b){var c=this;null!==b.fnInit&&b.fnInit.call(this,a,b);""!==b.sToolTip&&(a.title=b.sToolTip);f(a).hover(function(){b.fnMouseover!==null&&b.fnMouseover.call(this,a,b,null)},
function(){b.fnMouseout!==null&&b.fnMouseout.call(this,a,b,null)});null!==b.fnSelect&&TableTools._fnEventListen(this,"select",function(d){b.fnSelect.call(c,a,b,d)});f(a).click(function(d){b.fnClick!==null&&b.fnClick.call(c,a,b,null,d);b.fnComplete!==null&&b.fnComplete.call(c,a,b,null,null);c._fnCollectionHide(a,b)})},_fnHasFlash:function(){try{if(new ActiveXObject("ShockwaveFlash.ShockwaveFlash"))return!0}catch(a){if(navigator.mimeTypes&&navigator.mimeTypes["application/x-shockwave-flash"]!==p&&navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin)return!0}return!1},
_fnFlashConfig:function(a,b){var c=this,d=new g.Client;null!==b.fnInit&&b.fnInit.call(this,a,b);d.setHandCursor(!0);"flash_save"==b.sAction?(d.setAction("save"),d.setCharSet("utf16le"==b.sCharSet?"UTF16LE":"UTF8"),d.setBomInc(b.bBomInc),d.setFileName(b.sFileName.replace("*",this.fnGetTitle(b)))):"flash_pdf"==b.sAction?(d.setAction("pdf"),d.setFileName(b.sFileName.replace("*",this.fnGetTitle(b)))):d.setAction("copy");d.addEventListener("mouseOver",function(){b.fnMouseover!==null&&b.fnMouseover.call(c,
a,b,d)});d.addEventListener("mouseOut",function(){b.fnMouseout!==null&&b.fnMouseout.call(c,a,b,d)});d.addEventListener("mouseDown",function(){b.fnClick!==null&&b.fnClick.call(c,a,b,d)});d.addEventListener("complete",function(e,f){b.fnComplete!==null&&b.fnComplete.call(c,a,b,d,f);c._fnCollectionHide(a,b)});this._fnFlashGlue(d,a,b.sToolTip)},_fnFlashGlue:function(a,b,c){var d=this,e=b.getAttribute("id");k.getElementById(e)?a.glue(b,c):setTimeout(function(){d._fnFlashGlue(a,b,c)},100)},_fnFlashSetText:function(a,
b){var c=this._fnChunkData(b,8192);a.clearText();for(var d=0,e=c.length;d<e;d++)a.appendText(c[d])},_fnColumnTargets:function(a){var b=[],c=this.s.dt,d,e;if("object"==typeof a){d=0;for(e=c.aoColumns.length;d<e;d++)b.push(!1);d=0;for(e=a.length;d<e;d++)b[a[d]]=!0}else if("visible"==a){d=0;for(e=c.aoColumns.length;d<e;d++)b.push(c.aoColumns[d].bVisible?!0:!1)}else if("hidden"==a){d=0;for(e=c.aoColumns.length;d<e;d++)b.push(c.aoColumns[d].bVisible?!1:!0)}else if("sortable"==a){d=0;for(e=c.aoColumns.length;d<
e;d++)b.push(c.aoColumns[d].bSortable?!0:!1)}else{d=0;for(e=c.aoColumns.length;d<e;d++)b.push(!0)}return b},_fnNewline:function(a){return"auto"==a.sNewLine?navigator.userAgent.match(/Windows/)?"\r\n":"\n":a.sNewLine},_fnGetDataTablesData:function(a){var b,c,d,e,j,i=[],h="",g=this.s.dt,k,l=RegExp(a.sFieldBoundary,"g"),m=this._fnColumnTargets(a.mColumns),n="undefined"!=typeof a.bSelectedOnly?a.bSelectedOnly:!1;if(a.bHeader){j=[];b=0;for(c=g.aoColumns.length;b<c;b++)m[b]&&(h=g.aoColumns[b].sTitle.replace(/\n/g,
" ").replace(/<.*?>/g,"").replace(/^\s+|\s+$/g,""),h=this._fnHtmlDecode(h),j.push(this._fnBoundData(h,a.sFieldBoundary,l)));i.push(j.join(a.sFieldSeperator))}var p=this.fnGetSelected(),n="none"!==this.s.select.type&&n&&0!==p.length,q=(d=f.fn.dataTable.Api)?(new d(g)).rows(a.oSelectorOpts).indexes().flatten().toArray():g.oInstance.$("tr",a.oSelectorOpts).map(function(a,b){return n&&-1===f.inArray(b,p)?null:g.oInstance.fnGetPosition(b)}).get();d=0;for(e=q.length;d<e;d++){k=g.aoData[q[d]].nTr;j=[];b=
0;for(c=g.aoColumns.length;b<c;b++)m[b]&&(h=g.oApi._fnGetCellData(g,q[d],b,"display"),a.fnCellRender?h=a.fnCellRender(h,b,k,q[d])+"":"string"==typeof h?(h=h.replace(/\n/g," "),h=h.replace(/<img.*?\s+alt\s*=\s*(?:"([^"]+)"|'([^']+)'|([^\s>]+)).*?>/gi,"$1$2$3"),h=h.replace(/<.*?>/g,"")):h+="",h=h.replace(/^\s+/,"").replace(/\s+$/,""),h=this._fnHtmlDecode(h),j.push(this._fnBoundData(h,a.sFieldBoundary,l)));i.push(j.join(a.sFieldSeperator));a.bOpenRows&&(b=f.grep(g.aoOpenRows,function(a){return a.nParent===
k}),1===b.length&&(h=this._fnBoundData(f("td",b[0].nTr).html(),a.sFieldBoundary,l),i.push(h)))}if(a.bFooter&&null!==g.nTFoot){j=[];b=0;for(c=g.aoColumns.length;b<c;b++)m[b]&&null!==g.aoColumns[b].nTf&&(h=g.aoColumns[b].nTf.innerHTML.replace(/\n/g," ").replace(/<.*?>/g,""),h=this._fnHtmlDecode(h),j.push(this._fnBoundData(h,a.sFieldBoundary,l)));i.push(j.join(a.sFieldSeperator))}return i.join(this._fnNewline(a))},_fnBoundData:function(a,b,c){return""===b?a:b+a.replace(c,b+b)+b},_fnChunkData:function(a,
b){for(var c=[],d=a.length,e=0;e<d;e+=b)e+b<d?c.push(a.substring(e,e+b)):c.push(a.substring(e,d));return c},_fnHtmlDecode:function(a){if(-1===a.indexOf("&"))return a;var b=k.createElement("div");return a.replace(/&([^\s]*?);/g,function(a,d){if("#"===a.substr(1,1))return String.fromCharCode(Number(d.substr(1)));b.innerHTML=a;return b.childNodes[0].nodeValue})},_fnPrintStart:function(a){var b=this,c=this.s.dt;this._fnPrintHideNodes(c.nTable);this.s.print.saveStart=c._iDisplayStart;this.s.print.saveLength=
c._iDisplayLength;a.bShowAll&&(c._iDisplayStart=0,c._iDisplayLength=-1,c.oApi._fnCalculateEnd&&c.oApi._fnCalculateEnd(c),c.oApi._fnDraw(c));if(""!==c.oScroll.sX||""!==c.oScroll.sY)this._fnPrintScrollStart(c),f(this.s.dt.nTable).bind("draw.DTTT_Print",function(){b._fnPrintScrollStart(c)});var d=c.aanFeatures,e;for(e in d)if("i"!=e&&"t"!=e&&1==e.length)for(var g=0,i=d[e].length;g<i;g++)this.dom.print.hidden.push({node:d[e][g],display:"block"}),d[e][g].style.display="none";f(k.body).addClass(this.classes.print.body);
""!==a.sInfo&&this.fnInfo(a.sInfo,3E3);a.sMessage&&f("<div/>").addClass(this.classes.print.message).html(a.sMessage).prependTo("body");this.s.print.saveScroll=f(m).scrollTop();m.scrollTo(0,0);f(k).bind("keydown.DTTT",function(a){if(a.keyCode==27){a.preventDefault();b._fnPrintEnd.call(b,a)}})},_fnPrintEnd:function(){var a=this.s.dt,b=this.s.print;this._fnPrintShowNodes();if(""!==a.oScroll.sX||""!==a.oScroll.sY)f(this.s.dt.nTable).unbind("draw.DTTT_Print"),this._fnPrintScrollEnd();m.scrollTo(0,b.saveScroll);
f("div."+this.classes.print.message).remove();f(k.body).removeClass("DTTT_Print");a._iDisplayStart=b.saveStart;a._iDisplayLength=b.saveLength;a.oApi._fnCalculateEnd&&a.oApi._fnCalculateEnd(a);a.oApi._fnDraw(a);f(k).unbind("keydown.DTTT")},_fnPrintScrollStart:function(){var a=this.s.dt;a.nScrollHead.getElementsByTagName("div")[0].getElementsByTagName("table");var b=a.nTable.parentNode,c;c=a.nTable.getElementsByTagName("thead");0<c.length&&a.nTable.removeChild(c[0]);null!==a.nTFoot&&(c=a.nTable.getElementsByTagName("tfoot"),
0<c.length&&a.nTable.removeChild(c[0]));c=a.nTHead.cloneNode(!0);a.nTable.insertBefore(c,a.nTable.childNodes[0]);null!==a.nTFoot&&(c=a.nTFoot.cloneNode(!0),a.nTable.insertBefore(c,a.nTable.childNodes[1]));""!==a.oScroll.sX&&(a.nTable.style.width=f(a.nTable).outerWidth()+"px",b.style.width=f(a.nTable).outerWidth()+"px",b.style.overflow="visible");""!==a.oScroll.sY&&(b.style.height=f(a.nTable).outerHeight()+"px",b.style.overflow="visible")},_fnPrintScrollEnd:function(){var a=this.s.dt,b=a.nTable.parentNode;
""!==a.oScroll.sX&&(b.style.width=a.oApi._fnStringToCss(a.oScroll.sX),b.style.overflow="auto");""!==a.oScroll.sY&&(b.style.height=a.oApi._fnStringToCss(a.oScroll.sY),b.style.overflow="auto")},_fnPrintShowNodes:function(){for(var a=this.dom.print.hidden,b=0,c=a.length;b<c;b++)a[b].node.style.display=a[b].display;a.splice(0,a.length)},_fnPrintHideNodes:function(a){for(var b=this.dom.print.hidden,c=a.parentNode,d=c.childNodes,e=0,g=d.length;e<g;e++)if(d[e]!=a&&1==d[e].nodeType){var i=f(d[e]).css("display");
"none"!=i&&(b.push({node:d[e],display:i}),d[e].style.display="none")}"BODY"!=c.nodeName.toUpperCase()&&this._fnPrintHideNodes(c)}};TableTools._aInstances=[];TableTools._aListeners=[];TableTools.fnGetMasters=function(){for(var a=[],b=0,c=TableTools._aInstances.length;b<c;b++)TableTools._aInstances[b].s.master&&a.push(TableTools._aInstances[b]);return a};TableTools.fnGetInstance=function(a){"object"!=typeof a&&(a=k.getElementById(a));for(var b=0,c=TableTools._aInstances.length;b<c;b++)if(TableTools._aInstances[b].s.master&&
TableTools._aInstances[b].dom.table==a)return TableTools._aInstances[b];return null};TableTools._fnEventListen=function(a,b,c){TableTools._aListeners.push({that:a,type:b,fn:c})};TableTools._fnEventDispatch=function(a,b,c,d){for(var e=TableTools._aListeners,f=0,g=e.length;f<g;f++)a.dom.table==e[f].that.dom.table&&e[f].type==b&&e[f].fn(c,d)};TableTools.buttonBase={sAction:"text",sTag:"default",sLinerTag:"default",sButtonClass:"DTTT_button_text",sButtonText:"Button text",sTitle:"",sToolTip:"",sCharSet:"utf8",
bBomInc:!1,sFileName:"*.csv",sFieldBoundary:"",sFieldSeperator:"\t",sNewLine:"auto",mColumns:"all",bHeader:!0,bFooter:!0,bOpenRows:!1,bSelectedOnly:!1,oSelectorOpts:p,fnMouseover:null,fnMouseout:null,fnClick:null,fnSelect:null,fnComplete:null,fnInit:null,fnCellRender:null};TableTools.BUTTONS={csv:f.extend({},TableTools.buttonBase,{sAction:"flash_save",sButtonClass:"DTTT_button_csv",sButtonText:"CSV",sFieldBoundary:'"',sFieldSeperator:",",fnClick:function(a,b,c){this.fnSetText(c,this.fnGetTableData(b))}}),
xls:f.extend({},TableTools.buttonBase,{sAction:"flash_save",sCharSet:"utf16le",bBomInc:!0,sButtonClass:"DTTT_button_xls",sButtonText:"Excel",fnClick:function(a,b,c){this.fnSetText(c,this.fnGetTableData(b))}}),copy:f.extend({},TableTools.buttonBase,{sAction:"flash_copy",sButtonClass:"DTTT_button_copy",sButtonText:"Copy",fnClick:function(a,b,c){this.fnSetText(c,this.fnGetTableData(b))},fnComplete:function(a,b,c,d){a=d.split("\n").length;b.bHeader&&a--;null!==this.s.dt.nTFoot&&b.bFooter&&a--;this.fnInfo("<h6>Table copied</h6><p>Copied "+
a+" row"+(1==a?"":"s")+" to the clipboard.</p>",1500)}}),pdf:f.extend({},TableTools.buttonBase,{sAction:"flash_pdf",sNewLine:"\n",sFileName:"*.pdf",sButtonClass:"DTTT_button_pdf",sButtonText:"PDF",sPdfOrientation:"portrait",sPdfSize:"A4",sPdfMessage:"",fnClick:function(a,b,c){this.fnSetText(c,"title:"+this.fnGetTitle(b)+"\nmessage:"+b.sPdfMessage+"\ncolWidth:"+this.fnCalcColRatios(b)+"\norientation:"+b.sPdfOrientation+"\nsize:"+b.sPdfSize+"\n--/TableToolsOpts--\n"+this.fnGetTableData(b))}}),print:f.extend({},
TableTools.buttonBase,{sInfo:"<h6>Print view</h6><p>Please use your browser's print function to print this table. Press escape when finished.</p>",sMessage:null,bShowAll:!0,sToolTip:"View print view",sButtonClass:"DTTT_button_print",sButtonText:"Print",fnClick:function(a,b){this.fnPrint(!0,b)}}),text:f.extend({},TableTools.buttonBase),select:f.extend({},TableTools.buttonBase,{sButtonText:"Select button",fnSelect:function(a){0!==this.fnGetSelected().length?f(a).removeClass(this.classes.buttons.disabled):
f(a).addClass(this.classes.buttons.disabled)},fnInit:function(a){f(a).addClass(this.classes.buttons.disabled)}}),select_single:f.extend({},TableTools.buttonBase,{sButtonText:"Select button",fnSelect:function(a){1==this.fnGetSelected().length?f(a).removeClass(this.classes.buttons.disabled):f(a).addClass(this.classes.buttons.disabled)},fnInit:function(a){f(a).addClass(this.classes.buttons.disabled)}}),select_all:f.extend({},TableTools.buttonBase,{sButtonText:"Select all",fnClick:function(){this.fnSelectAll()},
fnSelect:function(a){this.fnGetSelected().length==this.s.dt.fnRecordsDisplay()?f(a).addClass(this.classes.buttons.disabled):f(a).removeClass(this.classes.buttons.disabled)}}),select_none:f.extend({},TableTools.buttonBase,{sButtonText:"Deselect all",fnClick:function(){this.fnSelectNone()},fnSelect:function(a){0!==this.fnGetSelected().length?f(a).removeClass(this.classes.buttons.disabled):f(a).addClass(this.classes.buttons.disabled)},fnInit:function(a){f(a).addClass(this.classes.buttons.disabled)}}),
ajax:f.extend({},TableTools.buttonBase,{sAjaxUrl:"/xhr.php",sButtonText:"Ajax button",fnClick:function(a,b){var c=this.fnGetTableData(b);f.ajax({url:b.sAjaxUrl,data:[{name:"tableData",value:c}],success:b.fnAjaxComplete,dataType:"json",type:"POST",cache:!1,error:function(){alert("Error detected when sending table data to server")}})},fnAjaxComplete:function(){alert("Ajax complete")}}),div:f.extend({},TableTools.buttonBase,{sAction:"div",sTag:"div",sButtonClass:"DTTT_nonbutton",sButtonText:"Text button"}),
collection:f.extend({},TableTools.buttonBase,{sAction:"collection",sButtonClass:"DTTT_button_collection",sButtonText:"Collection",fnClick:function(a,b){this._fnCollectionShow(a,b)}})};TableTools.buttons=TableTools.BUTTONS;TableTools.classes={container:"DTTT_container",buttons:{normal:"DTTT_button",disabled:"DTTT_disabled"},collection:{container:"DTTT_collection",background:"DTTT_collection_background",buttons:{normal:"DTTT_button",disabled:"DTTT_disabled"}},select:{table:"DTTT_selectable",row:"DTTT_selected selected"},
print:{body:"DTTT_Print",info:"DTTT_print_info",message:"DTTT_PrintMessage"}};TableTools.classes_themeroller={container:"DTTT_container ui-buttonset ui-buttonset-multi",buttons:{normal:"DTTT_button ui-button ui-state-default"},collection:{container:"DTTT_collection ui-buttonset ui-buttonset-multi"}};TableTools.DEFAULTS={sSwfPath:"../swf/copy_csv_xls_pdf.swf",sRowSelect:"none",sRowSelector:"tr",sSelectedClass:null,fnPreRowSelect:null,fnRowSelected:null,fnRowDeselected:null,aButtons:["copy","csv","xls",
"pdf","print"],oTags:{container:"div",button:"a",liner:"span",collection:{container:"div",button:"a",liner:"span"}}};TableTools.defaults=TableTools.DEFAULTS;TableTools.prototype.CLASS="TableTools";TableTools.version="2.2.2";f.fn.dataTable.Api&&f.fn.dataTable.Api.register("tabletools()",function(){var a=null;0<this.context.length&&(a=TableTools.fnGetInstance(this.context[0].nTable));return a});"function"==typeof f.fn.dataTable&&"function"==typeof f.fn.dataTableExt.fnVersionCheck&&f.fn.dataTableExt.fnVersionCheck("1.9.0")?
f.fn.dataTableExt.aoFeatures.push({fnInit:function(a){var b=a.oInit;return(new TableTools(a.oInstance,b?b.tableTools||b.oTableTools||{}:{})).dom.container},cFeature:"T",sFeature:"TableTools"}):alert("Warning: TableTools requires DataTables 1.9.0 or newer - www.datatables.net/download");f.fn.DataTable.TableTools=TableTools;"function"==typeof n.fn.dataTable&&"function"==typeof n.fn.dataTableExt.fnVersionCheck&&n.fn.dataTableExt.fnVersionCheck("1.9.0")?n.fn.dataTableExt.aoFeatures.push({fnInit:function(a){a=
new TableTools(a.oInstance,"undefined"!=typeof a.oInit.oTableTools?a.oInit.oTableTools:{});TableTools._aInstances.push(a);return a.dom.container},cFeature:"T",sFeature:"TableTools"}):alert("Warning: TableTools 2 requires DataTables 1.9.0 or newer - www.datatables.net/download");n.fn.dataTable.TableTools=TableTools;return n.fn.DataTable.TableTools=TableTools};"function"===typeof define&&define.amd?define(["jquery","datatables"],r):"object"===typeof exports?r(require("jquery"),require("datatables")):
jQuery&&!jQuery.fn.dataTable.TableTools&&r(jQuery,jQuery.fn.dataTable)})(window,document);

/*!
 Scroller 1.2.2
 ©2011-2014 SpryMedia Ltd - datatables.net/license
*/
(function(m,n,k){var l=function(e){var g=function(a,b){!this instanceof g?alert("Scroller warning: Scroller must be initialised with the 'new' keyword."):("undefined"==typeof b&&(b={}),this.s={dt:a,tableTop:0,tableBottom:0,redrawTop:0,redrawBottom:0,autoHeight:!0,viewportRows:0,stateTO:null,drawTO:null,heights:{jump:null,page:null,virtual:null,scroll:null,row:null,viewport:null},topRowFloat:0,scrollDrawDiff:null,loaderVisible:!1},this.s=e.extend(this.s,g.oDefaults,b),this.s.heights.row=this.s.rowHeight,
this.dom={force:n.createElement("div"),scroller:null,table:null,loader:null},this.s.dt.oScroller=this,this._fnConstruct())};g.prototype={fnRowToPixels:function(a,b,c){a=c?this._domain("virtualToPhysical",a*this.s.heights.row):this.s.baseScrollTop+(a-this.s.baseRowTop)*this.s.heights.row;return b||b===k?parseInt(a,10):a},fnPixelsToRow:function(a,b,c){var d=a-this.s.baseScrollTop,a=c?this._domain("physicalToVirtual",a)/this.s.heights.row:d/this.s.heights.row+this.s.baseRowTop;return b||b===k?parseInt(a,
10):a},fnScrollToRow:function(a,b){var c=this,d=!1,f=this.fnRowToPixels(a),h=a-(this.s.displayBuffer-1)/2*this.s.viewportRows;0>h&&(h=0);if((f>this.s.redrawBottom||f<this.s.redrawTop)&&this.s.dt._iDisplayStart!==h)d=!0,f=this.fnRowToPixels(a,!1,!0);"undefined"==typeof b||b?(this.s.ani=d,e(this.dom.scroller).animate({scrollTop:f},function(){setTimeout(function(){c.s.ani=!1},25)})):e(this.dom.scroller).scrollTop(f)},fnMeasure:function(a){this.s.autoHeight&&this._fnCalcRowHeight();var b=this.s.heights;
b.viewport=e(this.dom.scroller).height();this.s.viewportRows=parseInt(b.viewport/b.row,10)+1;this.s.dt._iDisplayLength=this.s.viewportRows*this.s.displayBuffer;(a===k||a)&&this.s.dt.oInstance.fnDraw()},_fnConstruct:function(){var a=this;if(this.s.dt.oFeatures.bPaginate){this.dom.force.style.position="absolute";this.dom.force.style.top="0px";this.dom.force.style.left="0px";this.dom.force.style.width="1px";this.dom.scroller=e("div."+this.s.dt.oClasses.sScrollBody,this.s.dt.nTableWrapper)[0];this.dom.scroller.appendChild(this.dom.force);
this.dom.scroller.style.position="relative";this.dom.table=e(">table",this.dom.scroller)[0];this.dom.table.style.position="absolute";this.dom.table.style.top="0px";this.dom.table.style.left="0px";e(this.s.dt.nTableWrapper).addClass("DTS");this.s.loadingIndicator&&(this.dom.loader=e('<div class="DTS_Loading">'+this.s.dt.oLanguage.sLoadingRecords+"</div>").css("display","none"),e(this.dom.scroller.parentNode).css("position","relative").append(this.dom.loader));this.s.heights.row&&"auto"!=this.s.heights.row&&
(this.s.autoHeight=!1);this.fnMeasure(!1);this.s.ingnoreScroll=!0;this.s.stateSaveThrottle=this.s.dt.oApi._fnThrottle(function(){a.s.dt.oApi._fnSaveState(a.s.dt)},500);e(this.dom.scroller).on("scroll.DTS",function(){a._fnScroll.call(a)});e(this.dom.scroller).on("touchstart.DTS",function(){a._fnScroll.call(a)});this.s.dt.aoDrawCallback.push({fn:function(){a.s.dt.bInitialised&&a._fnDrawCallback.call(a)},sName:"Scroller"});e(m).on("resize.DTS",function(){a.fnMeasure(false);a._fnInfo()});var b=!0;this.s.dt.oApi._fnCallbackReg(this.s.dt,
"aoStateSaveParams",function(c,d){if(b&&a.s.dt.oLoadedState){d.iScroller=a.s.dt.oLoadedState.iScroller;d.iScrollerTopRow=a.s.dt.oLoadedState.iScrollerTopRow;b=false}else{d.iScroller=a.dom.scroller.scrollTop;d.iScrollerTopRow=a.s.topRowFloat}},"Scroller_State");this.s.dt.oLoadedState&&(this.s.topRowFloat=this.s.dt.oLoadedState.iScrollerTopRow||0);this.s.dt.aoDestroyCallback.push({sName:"Scroller",fn:function(){e(m).off("resize.DTS");e(a.dom.scroller).off("touchstart.DTS scroll.DTS");e(a.s.dt.nTableWrapper).removeClass("DTS");
e("div.DTS_Loading",a.dom.scroller.parentNode).remove();a.dom.table.style.position="";a.dom.table.style.top="";a.dom.table.style.left=""}})}else this.s.dt.oApi._fnLog(this.s.dt,0,"Pagination must be enabled for Scroller")},_fnScroll:function(){var a=this,b=this.s.heights,c=this.dom.scroller.scrollTop,d;if(!this.s.skip&&!this.s.ingnoreScroll)if(this.s.dt.bFiltered||this.s.dt.bSorted)this.s.lastScrollTop=0;else{this._fnInfo();clearTimeout(this.s.stateTO);this.s.stateTO=setTimeout(function(){a.s.dt.oApi._fnSaveState(a.s.dt)},
250);if(c<this.s.redrawTop||c>this.s.redrawBottom){var f=Math.ceil((this.s.displayBuffer-1)/2*this.s.viewportRows);Math.abs(c-this.s.lastScrollTop)>b.viewport||this.s.ani?(d=parseInt(this._domain("physicalToVirtual",c)/b.row,10)-f,this.s.topRowFloat=this._domain("physicalToVirtual",c)/b.row):(d=this.fnPixelsToRow(c)-f,this.s.topRowFloat=this.fnPixelsToRow(c,!1));0>=d?d=0:d+this.s.dt._iDisplayLength>this.s.dt.fnRecordsDisplay()?(d=this.s.dt.fnRecordsDisplay()-this.s.dt._iDisplayLength,0>d&&(d=0)):
0!==d%2&&d++;if(d!=this.s.dt._iDisplayStart&&(this.s.tableTop=e(this.s.dt.nTable).offset().top,this.s.tableBottom=e(this.s.dt.nTable).height()+this.s.tableTop,b=function(){if(a.s.scrollDrawReq===null)a.s.scrollDrawReq=c;a.s.dt._iDisplayStart=d;a.s.dt.oApi._fnCalculateEnd&&a.s.dt.oApi._fnCalculateEnd(a.s.dt);a.s.dt.oApi._fnDraw(a.s.dt)},this.s.dt.oFeatures.bServerSide?(clearTimeout(this.s.drawTO),this.s.drawTO=setTimeout(b,this.s.serverWait)):b(),this.dom.loader&&!this.s.loaderVisible))this.dom.loader.css("display",
"block"),this.s.loaderVisible=!0}this.s.lastScrollTop=c;this.s.stateSaveThrottle()}},_domain:function(a,b){var c=this.s.heights,d;if(c.virtual===c.scroll){d=(c.virtual-c.viewport)/(c.scroll-c.viewport);if("virtualToPhysical"===a)return b/d;if("physicalToVirtual"===a)return b*d}var e=(c.scroll-c.viewport)/2,h=(c.virtual-c.viewport)/2;d=h/(e*e);if("virtualToPhysical"===a){if(b<h)return Math.pow(b/d,0.5);b=2*h-b;return 0>b?c.scroll:2*e-Math.pow(b/d,0.5)}if("physicalToVirtual"===a){if(b<e)return b*b*
d;b=2*e-b;return 0>b?c.virtual:2*h-b*b*d}},_fnDrawCallback:function(){var a=this,b=this.s.heights,c=this.dom.scroller.scrollTop,d=e(this.s.dt.nTable).height(),f=this.s.dt._iDisplayStart,h=this.s.dt._iDisplayLength,g=this.s.dt.fnRecordsDisplay();this.s.skip=!0;this._fnScrollForce();c=0===f?this.s.topRowFloat*b.row:f+h>=g?b.scroll-(g-this.s.topRowFloat)*b.row:this._domain("virtualToPhysical",this.s.topRowFloat*b.row);this.dom.scroller.scrollTop=c;this.s.baseScrollTop=c;this.s.baseRowTop=this.s.topRowFloat;
var j=c-(this.s.topRowFloat-f)*b.row;0===f?j=0:f+h>=g&&(j=b.scroll-d);this.dom.table.style.top=j+"px";this.s.tableTop=j;this.s.tableBottom=d+this.s.tableTop;d=(c-this.s.tableTop)*this.s.boundaryScale;this.s.redrawTop=c-d;this.s.redrawBottom=c+d;this.s.skip=!1;this.s.dt.oFeatures.bStateSave&&null!==this.s.dt.oLoadedState&&"undefined"!=typeof this.s.dt.oLoadedState.iScroller?((c=(this.s.dt.sAjaxSource||a.s.dt.ajax)&&!this.s.dt.oFeatures.bServerSide?!0:!1)&&2==this.s.dt.iDraw||!c&&1==this.s.dt.iDraw)&&
setTimeout(function(){e(a.dom.scroller).scrollTop(a.s.dt.oLoadedState.iScroller);a.s.redrawTop=a.s.dt.oLoadedState.iScroller-b.viewport/2;setTimeout(function(){a.s.ingnoreScroll=!1},0)},0):a.s.ingnoreScroll=!1;setTimeout(function(){a._fnInfo.call(a)},0);this.dom.loader&&this.s.loaderVisible&&(this.dom.loader.css("display","none"),this.s.loaderVisible=!1)},_fnScrollForce:function(){var a=this.s.heights;a.virtual=a.row*this.s.dt.fnRecordsDisplay();a.scroll=a.virtual;1E6<a.scroll&&(a.scroll=1E6);this.dom.force.style.height=
a.scroll+"px"},_fnCalcRowHeight:function(){var a=this.s.dt,b=a.nTable,c=b.cloneNode(!1),d=e("<tbody/>").appendTo(c),f=e('<div class="'+a.oClasses.sWrapper+' DTS"><div class="'+a.oClasses.sScrollWrapper+'"><div class="'+a.oClasses.sScrollBody+'"></div></div></div>');for(e("tbody tr:lt(4)",b).clone().appendTo(d);3>e("tr",d).length;)d.append("<tr><td>&nbsp;</td></tr>");e("div."+a.oClasses.sScrollBody,f).append(c);a._bInitComplete?a=b.parentNode:(this.s.dt.nHolding||(this.s.dt.nHolding=e("<div></div>").insertBefore(this.s.dt.nTable)),
a=this.s.dt.nHolding);f.appendTo(a);this.s.heights.row=e("tr",d).eq(1).outerHeight();f.remove()},_fnInfo:function(){if(this.s.dt.oFeatures.bInfo){var a=this.s.dt,b=a.oLanguage,c=this.dom.scroller.scrollTop,d=Math.floor(this.fnPixelsToRow(c,!1,this.s.ani)+1),f=a.fnRecordsTotal(),h=a.fnRecordsDisplay(),c=Math.ceil(this.fnPixelsToRow(c+this.s.heights.viewport,!1,this.s.ani)),c=h<c?h:c,g=a.fnFormatNumber(d),j=a.fnFormatNumber(c),i=a.fnFormatNumber(f),k=a.fnFormatNumber(h),g=0===a.fnRecordsDisplay()&&
a.fnRecordsDisplay()==a.fnRecordsTotal()?b.sInfoEmpty+b.sInfoPostFix:0===a.fnRecordsDisplay()?b.sInfoEmpty+" "+b.sInfoFiltered.replace("_MAX_",i)+b.sInfoPostFix:a.fnRecordsDisplay()==a.fnRecordsTotal()?b.sInfo.replace("_START_",g).replace("_END_",j).replace("_MAX_",i).replace("_TOTAL_",k)+b.sInfoPostFix:b.sInfo.replace("_START_",g).replace("_END_",j).replace("_MAX_",i).replace("_TOTAL_",k)+" "+b.sInfoFiltered.replace("_MAX_",a.fnFormatNumber(a.fnRecordsTotal()))+b.sInfoPostFix;(b=b.fnInfoCallback)&&
(g=b.call(a.oInstance,a,d,c,f,h,g));a=a.aanFeatures.i;if("undefined"!=typeof a){d=0;for(f=a.length;d<f;d++)e(a[d]).html(g)}}}};g.defaults={trace:!1,rowHeight:"auto",serverWait:200,displayBuffer:9,boundaryScale:0.5,loadingIndicator:!1};g.oDefaults=g.defaults;g.version="1.2.2";"function"==typeof e.fn.dataTable&&"function"==typeof e.fn.dataTableExt.fnVersionCheck&&e.fn.dataTableExt.fnVersionCheck("1.9.0")?e.fn.dataTableExt.aoFeatures.push({fnInit:function(a){var b=a.oInit;return(new g(a,b.scroller||
b.oScroller||{})).dom.wrapper},cFeature:"S",sFeature:"Scroller"}):alert("Warning: Scroller requires DataTables 1.9.0 or greater - www.datatables.net/download");e.fn.dataTable.Scroller=g;e.fn.DataTable.Scroller=g;if(e.fn.dataTable.Api){var i=e.fn.dataTable.Api;i.register("scroller()",function(){return this});i.register("scroller().rowToPixels()",function(a,b,c){var d=this.context;if(d.length&&d[0].oScroller)return d[0].oScroller.fnRowToPixels(a,b,c)});i.register("scroller().pixelsToRow()",function(a,
b,c){var d=this.context;if(d.length&&d[0].oScroller)return d[0].oScroller.fnPixelsToRow(a,b,c)});i.register("scroller().scrollToRow()",function(a,b){this.iterator("table",function(c){c.oScroller&&c.oScroller.fnScrollToRow(a,b)});return this});i.register("scroller().measure()",function(a){this.iterator("table",function(b){b.oScroller&&b.oScroller.fnMeasure(a)});return this})}return g};"function"===typeof define&&define.amd?define(["jquery","datatables"],l):"object"===typeof exports?l(require("jquery"),
require("datatables")):jQuery&&!jQuery.fn.dataTable.Scroller&&l(jQuery,jQuery.fn.dataTable)})(window,document);

/*!
 ColReorder 1.1.2
 ©2010-2014 SpryMedia Ltd - datatables.net/license
*/
(function(n,q,r){function o(b){for(var f=[],a=0,e=b.length;a<e;a++)f[b[a]]=a;return f}function l(b,f,a){f=b.splice(f,1)[0];b.splice(a,0,f)}function p(b,f,a){for(var e=[],c=0,d=b.childNodes.length;c<d;c++)1==b.childNodes[c].nodeType&&e.push(b.childNodes[c]);f=e[f];null!==a?b.insertBefore(f,e[a]):b.appendChild(f)}$.fn.dataTableExt.oApi.fnColReorder=function(b,f,a){var e=$.fn.dataTable.Api?!0:!1,c,d,j,i,m=b.aoColumns.length,g,h;g=function(a,c,b){if(a[c]){var e=a[c].split("."),d=e.shift();isNaN(1*d)||
(a[c]=b[1*d]+"."+e.join("."))}};if(f!=a)if(0>f||f>=m)this.oApi._fnLog(b,1,"ColReorder 'from' index is out of bounds: "+f);else if(0>a||a>=m)this.oApi._fnLog(b,1,"ColReorder 'to' index is out of bounds: "+a);else{j=[];c=0;for(d=m;c<d;c++)j[c]=c;l(j,f,a);var k=o(j);c=0;for(d=b.aaSorting.length;c<d;c++)b.aaSorting[c][0]=k[b.aaSorting[c][0]];if(null!==b.aaSortingFixed){c=0;for(d=b.aaSortingFixed.length;c<d;c++)b.aaSortingFixed[c][0]=k[b.aaSortingFixed[c][0]]}c=0;for(d=m;c<d;c++){h=b.aoColumns[c];j=0;
for(i=h.aDataSort.length;j<i;j++)h.aDataSort[j]=k[h.aDataSort[j]];e&&(h.idx=k[h.idx])}e&&$.each(b.aLastSort,function(a,c){b.aLastSort[a].src=k[c.src]});c=0;for(d=m;c<d;c++)h=b.aoColumns[c],"number"==typeof h.mData?(h.mData=k[h.mData],b.oApi._fnColumnOptions(b,c,{})):$.isPlainObject(h.mData)&&(g(h.mData,"_",k),g(h.mData,"filter",k),g(h.mData,"sort",k),g(h.mData,"type",k),b.oApi._fnColumnOptions(b,c,{}));if(b.aoColumns[f].bVisible){j=this.oApi._fnColumnIndexToVisible(b,f);i=null;for(c=a<f?a:a+1;null===
i&&c<m;)i=this.oApi._fnColumnIndexToVisible(b,c),c++;g=b.nTHead.getElementsByTagName("tr");c=0;for(d=g.length;c<d;c++)p(g[c],j,i);if(null!==b.nTFoot){g=b.nTFoot.getElementsByTagName("tr");c=0;for(d=g.length;c<d;c++)p(g[c],j,i)}c=0;for(d=b.aoData.length;c<d;c++)null!==b.aoData[c].nTr&&p(b.aoData[c].nTr,j,i)}l(b.aoColumns,f,a);l(b.aoPreSearchCols,f,a);c=0;for(d=b.aoData.length;c<d;c++)g=b.aoData[c],e?(g.anCells&&l(g.anCells,f,a),"dom"!==g.src&&$.isArray(g._aData)&&l(g._aData,f,a)):($.isArray(g._aData)&&
l(g._aData,f,a),l(g._anHidden,f,a));c=0;for(d=b.aoHeader.length;c<d;c++)l(b.aoHeader[c],f,a);if(null!==b.aoFooter){c=0;for(d=b.aoFooter.length;c<d;c++)l(b.aoFooter[c],f,a)}e&&(new $.fn.dataTable.Api(b)).rows().invalidate();c=0;for(d=m;c<d;c++)$(b.aoColumns[c].nTh).off("click.DT"),this.oApi._fnSortAttachListener(b,b.aoColumns[c].nTh,c);$(b.oInstance).trigger("column-reorder",[b,{iFrom:f,iTo:a,aiInvertMapping:k}])}};n=function(b){var f=function(a,e){var c;b.fn.dataTable.Api?c=(new b.fn.dataTable.Api(a)).settings()[0]:
a.fnSettings?c=a.fnSettings():"string"===typeof a?b.fn.dataTable.fnIsDataTable(b(a)[0])&&(c=b(a).eq(0).dataTable().fnSettings()):a.nodeName&&"table"===a.nodeName.toLowerCase()?b.fn.dataTable.fnIsDataTable(a.nodeName)&&(c=b(a.nodeName).dataTable().fnSettings()):a instanceof jQuery?b.fn.dataTable.fnIsDataTable(a[0])&&(c=a.eq(0).dataTable().fnSettings()):c=a;var d=b.fn.dataTable.camelToHungarian;d&&(d(f.defaults,f.defaults,!0),d(f.defaults,e||{}));this.s={dt:null,init:b.extend(!0,{},f.defaults,e),fixed:0,
fixedRight:0,dropCallback:null,mouse:{startX:-1,startY:-1,offsetX:-1,offsetY:-1,target:-1,targetIndex:-1,fromIndex:-1},aoTargets:[]};this.dom={drag:null,pointer:null};this.s.dt=c.oInstance.fnSettings();this.s.dt._colReorder=this;this._fnConstruct();c.oApi._fnCallbackReg(c,"aoDestroyCallback",b.proxy(this._fnDestroy,this),"ColReorder");return this};f.prototype={fnReset:function(){for(var a=[],b=0,c=this.s.dt.aoColumns.length;b<c;b++)a.push(this.s.dt.aoColumns[b]._ColReorder_iOrigCol);this._fnOrderColumns(a);
return this},fnGetCurrentOrder:function(){return this.fnOrder()},fnOrder:function(a){if(a===r){for(var a=[],b=0,c=this.s.dt.aoColumns.length;b<c;b++)a.push(this.s.dt.aoColumns[b]._ColReorder_iOrigCol);return a}this._fnOrderColumns(o(a));return this},_fnConstruct:function(){var a=this,b=this.s.dt.aoColumns.length,c;this.s.init.iFixedColumns&&(this.s.fixed=this.s.init.iFixedColumns);this.s.fixedRight=this.s.init.iFixedColumnsRight?this.s.init.iFixedColumnsRight:0;this.s.init.fnReorderCallback&&(this.s.dropCallback=
this.s.init.fnReorderCallback);for(c=0;c<b;c++)c>this.s.fixed-1&&c<b-this.s.fixedRight&&this._fnMouseListener(c,this.s.dt.aoColumns[c].nTh),this.s.dt.aoColumns[c]._ColReorder_iOrigCol=c;this.s.dt.oApi._fnCallbackReg(this.s.dt,"aoStateSaveParams",function(c,b){a._fnStateSave.call(a,b)},"ColReorder_State");var d=null;this.s.init.aiOrder&&(d=this.s.init.aiOrder.slice());this.s.dt.oLoadedState&&("undefined"!=typeof this.s.dt.oLoadedState.ColReorder&&this.s.dt.oLoadedState.ColReorder.length==this.s.dt.aoColumns.length)&&
(d=this.s.dt.oLoadedState.ColReorder);if(d)if(a.s.dt._bInitComplete)b=o(d),a._fnOrderColumns.call(a,b);else{var f=!1;this.s.dt.aoDrawCallback.push({fn:function(){if(!a.s.dt._bInitComplete&&!f){f=true;var c=o(d);a._fnOrderColumns.call(a,c)}},sName:"ColReorder_Pre"})}else this._fnSetColumnIndexes()},_fnOrderColumns:function(a){if(a.length!=this.s.dt.aoColumns.length)this.s.dt.oInstance.oApi._fnLog(this.s.dt,1,"ColReorder - array reorder does not match known number of columns. Skipping.");else{for(var e=
0,c=a.length;e<c;e++){var d=b.inArray(e,a);e!=d&&(l(a,d,e),this.s.dt.oInstance.fnColReorder(d,e))}(""!==this.s.dt.oScroll.sX||""!==this.s.dt.oScroll.sY)&&this.s.dt.oInstance.fnAdjustColumnSizing();this.s.dt.oInstance.oApi._fnSaveState(this.s.dt);this._fnSetColumnIndexes()}},_fnStateSave:function(a){var e,c,d,f=this.s.dt.aoColumns;a.ColReorder=[];if(a.aaSorting){for(e=0;e<a.aaSorting.length;e++)a.aaSorting[e][0]=f[a.aaSorting[e][0]]._ColReorder_iOrigCol;var i=b.extend(!0,[],a.aoSearchCols);e=0;for(c=
f.length;e<c;e++)d=f[e]._ColReorder_iOrigCol,a.aoSearchCols[d]=i[e],a.abVisCols[d]=f[e].bVisible,a.ColReorder.push(d)}else if(a.order){for(e=0;e<a.order.length;e++)a.order[e][0]=f[a.order[e][0]]._ColReorder_iOrigCol;i=b.extend(!0,[],a.columns);e=0;for(c=f.length;e<c;e++)d=f[e]._ColReorder_iOrigCol,a.columns[d]=i[e],a.ColReorder.push(d)}},_fnMouseListener:function(a,e){var c=this;b(e).on("mousedown.ColReorder",function(a){a.preventDefault();c._fnMouseDown.call(c,a,e)})},_fnMouseDown:function(a,e){var c=
this,d=b(a.target).closest("th, td").offset(),f=parseInt(b(e).attr("data-column-index"),10);f!==r&&(this.s.mouse.startX=a.pageX,this.s.mouse.startY=a.pageY,this.s.mouse.offsetX=a.pageX-d.left,this.s.mouse.offsetY=a.pageY-d.top,this.s.mouse.target=this.s.dt.aoColumns[f].nTh,this.s.mouse.targetIndex=f,this.s.mouse.fromIndex=f,this._fnRegions(),b(q).on("mousemove.ColReorder",function(a){c._fnMouseMove.call(c,a)}).on("mouseup.ColReorder",function(a){c._fnMouseUp.call(c,a)}))},_fnMouseMove:function(a){if(null===
this.dom.drag){if(5>Math.pow(Math.pow(a.pageX-this.s.mouse.startX,2)+Math.pow(a.pageY-this.s.mouse.startY,2),0.5))return;this._fnCreateDragNode()}this.dom.drag.css({left:a.pageX-this.s.mouse.offsetX,top:a.pageY-this.s.mouse.offsetY});for(var b=!1,c=this.s.mouse.toIndex,d=1,f=this.s.aoTargets.length;d<f;d++)if(a.pageX<this.s.aoTargets[d-1].x+(this.s.aoTargets[d].x-this.s.aoTargets[d-1].x)/2){this.dom.pointer.css("left",this.s.aoTargets[d-1].x);this.s.mouse.toIndex=this.s.aoTargets[d-1].to;b=!0;break}b||
(this.dom.pointer.css("left",this.s.aoTargets[this.s.aoTargets.length-1].x),this.s.mouse.toIndex=this.s.aoTargets[this.s.aoTargets.length-1].to);this.s.init.bRealtime&&c!==this.s.mouse.toIndex&&(this.s.dt.oInstance.fnColReorder(this.s.mouse.fromIndex,this.s.mouse.toIndex),this.s.mouse.fromIndex=this.s.mouse.toIndex,this._fnRegions())},_fnMouseUp:function(){b(q).off("mousemove.ColReorder mouseup.ColReorder");null!==this.dom.drag&&(this.dom.drag.remove(),this.dom.pointer.remove(),this.dom.drag=null,
this.dom.pointer=null,this.s.dt.oInstance.fnColReorder(this.s.mouse.fromIndex,this.s.mouse.toIndex),this._fnSetColumnIndexes(),(""!==this.s.dt.oScroll.sX||""!==this.s.dt.oScroll.sY)&&this.s.dt.oInstance.fnAdjustColumnSizing(),null!==this.s.dropCallback&&this.s.dropCallback.call(this),this.s.dt.oInstance.oApi._fnSaveState(this.s.dt))},_fnRegions:function(){var a=this.s.dt.aoColumns;this.s.aoTargets.splice(0,this.s.aoTargets.length);this.s.aoTargets.push({x:b(this.s.dt.nTable).offset().left,to:0});
for(var e=0,c=0,d=a.length;c<d;c++)c!=this.s.mouse.fromIndex&&e++,a[c].bVisible&&this.s.aoTargets.push({x:b(a[c].nTh).offset().left+b(a[c].nTh).outerWidth(),to:e});0!==this.s.fixedRight&&this.s.aoTargets.splice(this.s.aoTargets.length-this.s.fixedRight);0!==this.s.fixed&&this.s.aoTargets.splice(0,this.s.fixed)},_fnCreateDragNode:function(){var a=""!==this.s.dt.oScroll.sX||""!==this.s.dt.oScroll.sY,e=this.s.dt.aoColumns[this.s.mouse.targetIndex].nTh,c=e.parentNode,d=c.parentNode,f=d.parentNode,i=b(e).clone();
this.dom.drag=b(f.cloneNode(!1)).addClass("DTCR_clonedTable").append(d.cloneNode(!1).appendChild(c.cloneNode(!1).appendChild(i[0]))).css({position:"absolute",top:0,left:0,width:b(e).outerWidth(),height:b(e).outerHeight()}).appendTo("body");this.dom.pointer=b("<div></div>").addClass("DTCR_pointer").css({position:"absolute",top:a?b("div.dataTables_scroll",this.s.dt.nTableWrapper).offset().top:b(this.s.dt.nTable).offset().top,height:a?b("div.dataTables_scroll",this.s.dt.nTableWrapper).height():b(this.s.dt.nTable).height()}).appendTo("body")},
_fnDestroy:function(){var a,e;a=0;for(e=this.s.dt.aoDrawCallback.length;a<e;a++)if("ColReorder_Pre"===this.s.dt.aoDrawCallback[a].sName){this.s.dt.aoDrawCallback.splice(a,1);break}b(this.s.dt.nTHead).find("*").off(".ColReorder");b.each(this.s.dt.aoColumns,function(a,e){b(e.nTh).removeAttr("data-column-index")});this.s=this.s.dt._colReorder=null},_fnSetColumnIndexes:function(){b.each(this.s.dt.aoColumns,function(a,e){b(e.nTh).attr("data-column-index",a)})}};f.defaults={aiOrder:null,bRealtime:!1,iFixedColumns:0,
iFixedColumnsRight:0,fnReorderCallback:null};f.version="1.1.2";b.fn.dataTable.ColReorder=f;b.fn.DataTable.ColReorder=f;"function"==typeof b.fn.dataTable&&"function"==typeof b.fn.dataTableExt.fnVersionCheck&&b.fn.dataTableExt.fnVersionCheck("1.9.3")?b.fn.dataTableExt.aoFeatures.push({fnInit:function(a){var b=a.oInstance;a._colReorder?b.oApi._fnLog(a,1,"ColReorder attempted to initialise twice. Ignoring second"):(b=a.oInit,new f(a,b.colReorder||b.oColReorder||{}));return null},cFeature:"R",sFeature:"ColReorder"}):
alert("Warning: ColReorder requires DataTables 1.9.3 or greater - www.datatables.net/download");b.fn.dataTable.Api&&(b.fn.dataTable.Api.register("colReorder.reset()",function(){return this.iterator("table",function(a){a._colReorder.fnReset()})}),b.fn.dataTable.Api.register("colReorder.order()",function(a){return a?this.iterator("table",function(b){b._colReorder.fnOrder(a)}):this.context.length?this.context[0]._colReorder.fnOrder():null}));return f};"function"===typeof define&&define.amd?define(["jquery",
"datatables"],n):"object"===typeof exports?n(require("jquery"),require("datatables")):jQuery&&!jQuery.fn.dataTable.ColReorder&&n(jQuery,jQuery.fn.dataTable)})(window,document);

/*!
Bootstrap Datatables Integration.
*/

/* Set the defaults for DataTables initialisation */
$.extend(true, $.fn.dataTable.defaults, {
    "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // default layout with horizobtal scrollable datatable
    //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // datatable layout without  horizobtal scroll(used when bootstrap dropdowns used in the datatable cells)
    "language": {
        "lengthMenu": " _MENU_ records ",
        "paginate": {
            "previous": '<i class="fa fa-angle-left"></i>',
            "next": '<i class="fa fa-angle-right"></i>'
        }
    }
});

/* Default class modification */
$.extend($.fn.dataTableExt.oStdClasses, {
    "sWrapper": "dataTables_wrapper",
    "sFilterInput": "form-control input-small input-inline",
    "sLengthSelect": "form-control input-xsmall input-inline"
});

// In 1.10 we use the pagination renderers to draw the Bootstrap paging,
// rather than  custom plug-in
$.fn.dataTable.defaults.renderer = 'bootstrap';
$.fn.dataTable.ext.renderer.pageButton.bootstrap = function (settings, host, idx, buttons, page, pages) {
    var api = new $.fn.dataTable.Api(settings);
    var classes = settings.oClasses;
    var lang = settings.oLanguage.oPaginate;
    var btnDisplay, btnClass;

    var attach = function (container, buttons) {
        var i, ien, node, button;
        var clickHandler = function (e) {
            e.preventDefault();
            if (e.data.action !== 'ellipsis') {
                api.page(e.data.action).draw(false);
            }
        };

        for (i = 0, ien = buttons.length; i < ien; i++) {
            button = buttons[i];

            if ($.isArray(button)) {
                attach(container, button);
            } else {
                btnDisplay = '';
                btnClass = '';

                switch (button) {
                case 'ellipsis':
                    btnDisplay = '&hellip;';
                    btnClass = 'disabled';
                    break;

                case 'first':
                    btnDisplay = lang.sFirst;
                    btnClass = button + (page > 0 ?
                        '' : ' disabled');
                    break;

                case 'previous':
                    btnDisplay = lang.sPrevious;
                    btnClass = button + (page > 0 ?
                        '' : ' disabled');
                    break;

                case 'next':
                    btnDisplay = lang.sNext;
                    btnClass = button + (page < pages - 1 ?
                        '' : ' disabled');
                    break;

                case 'last':
                    btnDisplay = lang.sLast;
                    btnClass = button + (page < pages - 1 ?
                        '' : ' disabled');
                    break;

                default:
                    btnDisplay = button + 1;
                    btnClass = page === button ?
                        'active' : '';
                    break;
                }

                if (btnDisplay) {
                    node = $('<li>', {
                        'class': classes.sPageButton + ' ' + btnClass,
                        'aria-controls': settings.sTableId,
                        'tabindex': settings.iTabIndex,
                        'id': idx === 0 && typeof button === 'string' ?
                            settings.sTableId + '_' + button : null
                    })
                        .append($('<a>', {
                                'href': '#'
                            })
                            .html(btnDisplay)
                    )
                        .appendTo(container);

                    settings.oApi._fnBindAction(
                        node, {
                            action: button
                        }, clickHandler
                    );
                }
            }
        }
    };

    attach(
        $(host).empty().html('<ul class="pagination"/>').children('ul'),
        buttons
    );
}

/*
 * TableTools Bootstrap compatibility
 * Required TableTools 2.1+
 */
if ($.fn.DataTable.TableTools) {
    // Set the classes that TableTools uses to something suitable for Bootstrap
    $.extend(true, $.fn.DataTable.TableTools.classes, {
        "container": "DTTT btn-group",
        "buttons": {
            "normal": "btn btn-default",
            "disabled": "disabled"
        },
        "collection": {
            "container": "DTTT_dropdown dropdown-menu",
            "buttons": {
                "normal": "",
                "disabled": "disabled"
            }
        },
        "print": {
            "info": "DTTT_Print_Info"  
        },
        "select": {
            "row": "active"
        }
    });

    // Have the collection use a bootstrap compatible dropdown
    $.extend(true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
        "collection": {
            "container": "ul",
            "button": "li",
            "liner": "a"
        }
    });
}

/***
Custom Pagination
***/

/* API method to get paging information */
$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
    return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": oSettings._iDisplayLength === -1 ?
            0 : Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": oSettings._iDisplayLength === -1 ?
            0 : Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
};

/* Bootstrap style full number pagination control */
$.extend($.fn.dataTableExt.oPagination, {
    "bootstrap_full_number": {
        "fnInit": function (oSettings, nPaging, fnDraw) {
            var oLang = oSettings.oLanguage.oPaginate;
            var fnClickHandler = function (e) {
                e.preventDefault();
                if (oSettings.oApi._fnPageChange(oSettings, e.data.action)) {
                    fnDraw(oSettings);
                }
            };

            $(nPaging).append(
                '<ul class="pagination">' +
                '<li class="prev disabled"><a href="#" title="' + oLang.sFirst + '"><i class="fa fa-angle-double-left"></i></a></li>' +
                '<li class="prev disabled"><a href="#" title="' + oLang.sPrevious + '"><i class="fa fa-angle-left"></i></a></li>' +
                '<li class="next disabled"><a href="#" title="' + oLang.sNext + '"><i class="fa fa-angle-right"></i></a></li>' +
                '<li class="next disabled"><a href="#" title="' + oLang.sLast + '"><i class="fa fa-angle-double-right"></i></a></li>' +
                '</ul>'
            );
            var els = $('a', nPaging);
            $(els[0]).bind('click.DT', {
                action: "first"
            }, fnClickHandler);
            $(els[1]).bind('click.DT', {
                action: "previous"
            }, fnClickHandler);
            $(els[2]).bind('click.DT', {
                action: "next"
            }, fnClickHandler);
            $(els[3]).bind('click.DT', {
                action: "last"
            }, fnClickHandler);
        },

        "fnUpdate": function (oSettings, fnDraw) {
            var iListLength = 5;
            var oPaging = oSettings.oInstance.fnPagingInfo();
            var an = oSettings.aanFeatures.p;
            var i, j, sClass, iStart, iEnd, iHalf = Math.floor(iListLength / 2);

            if (oPaging.iTotalPages < iListLength) {
                iStart = 1;
                iEnd = oPaging.iTotalPages;
            } else if (oPaging.iPage <= iHalf) {
                iStart = 1;
                iEnd = iListLength;
            } else if (oPaging.iPage >= (oPaging.iTotalPages - iHalf)) {
                iStart = oPaging.iTotalPages - iListLength + 1;
                iEnd = oPaging.iTotalPages;
            } else {
                iStart = oPaging.iPage - iHalf + 1;
                iEnd = iStart + iListLength - 1;
            }



            for (i = 0, iLen = an.length; i < iLen; i++) {
                if (oPaging.iTotalPages <= 0) {
                    $('.pagination', an[i]).css('visibility', 'hidden');
                } else {
                    $('.pagination', an[i]).css('visibility', 'visible');
                }

                // Remove the middle elements
                $('li:gt(1)', an[i]).filter(':not(.next)').remove();

                // Add the new list items and their event handlers
                for (j = iStart; j <= iEnd; j++) {
                    sClass = (j == oPaging.iPage + 1) ? 'class="active"' : '';
                    $('<li ' + sClass + '><a href="#">' + j + '</a></li>')
                        .insertBefore($('li.next:first', an[i])[0])
                        .bind('click', function (e) {
                            e.preventDefault();
                            oSettings._iDisplayStart = (parseInt($('a', this).text(), 10) - 1) * oPaging.iLength;
                            fnDraw(oSettings);
                        });
                }

                // Add / remove disabled classes from the static elements
                if (oPaging.iPage === 0) {
                    $('li.prev', an[i]).addClass('disabled');
                } else {
                    $('li.prev', an[i]).removeClass('disabled');
                }

                if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                    $('li.next', an[i]).addClass('disabled');
                } else {
                    $('li.next', an[i]).removeClass('disabled');
                }
            }
        }
    }
});

/* Bootstrap style full number pagination control */
$.extend($.fn.dataTableExt.oPagination, {
    "bootstrap_extended": {
        "fnInit": function (oSettings, nPaging, fnDraw) {
            var oLang = oSettings.oLanguage.oPaginate;
            var oPaging = oSettings.oInstance.fnPagingInfo();

            var fnClickHandler = function (e) {
                e.preventDefault();
                if (oSettings.oApi._fnPageChange(oSettings, e.data.action)) {
                    fnDraw(oSettings);
                }
            };

            $(nPaging).append(
                '<div class="pagination-panel"> ' + oLang.page + ' ' +
                '<a href="#" class="btn btn-sm default prev disabled" title="' + oLang.previous + '"><i class="fa fa-angle-left"></i></a>' +
                '<input type="text" class="pagination-panel-input form-control input-mini input-inline input-sm" maxlenght="5" style="text-align:center; margin: 0 5px;">' +
                '<a href="#" class="btn btn-sm default next disabled" title="' + oLang.next + '"><i class="fa fa-angle-right"></i></a> ' +
                oLang.pageOf + ' <span class="pagination-panel-total"></span>' +
                '</div>'
            );

            var els = $('a', nPaging);

            $(els[0]).bind('click.DT', {
                action: "previous"
            }, fnClickHandler);
            $(els[1]).bind('click.DT', {
                action: "next"
            }, fnClickHandler);

            $('.pagination-panel-input', nPaging).bind('change.DT', function (e) {
                var oPaging = oSettings.oInstance.fnPagingInfo();
                e.preventDefault();
                var page = parseInt($(this).val());
                if (page > 0 && page <= oPaging.iTotalPages) {
                    if (oSettings.oApi._fnPageChange(oSettings, page - 1)) {
                        fnDraw(oSettings);
                    }
                } else {
                    $(this).val(oPaging.iPage + 1);
                }
            });

            $('.pagination-panel-input', nPaging).bind('keypress.DT', function (e) {
                var oPaging = oSettings.oInstance.fnPagingInfo();
				
                if (e.which == 13) {
                    var page = parseInt($(this).val());
                    if (page > 0 && page <= oSettings.oInstance.fnPagingInfo().iTotalPages) {
                        if (oSettings.oApi._fnPageChange(oSettings, page - 1)) {
                            fnDraw(oSettings);
                        }
                    } else {
                        $(this).val(oPaging.iPage + 1);
                    }
                    e.preventDefault();
                }
            });
        },

        "fnUpdate": function (oSettings, fnDraw) {
            var iListLength = 5;
            var oPaging = oSettings.oInstance.fnPagingInfo();
            var an = oSettings.aanFeatures.p;
            var i, j, sClass, iStart, iEnd, iHalf = Math.floor(iListLength / 2);

            if (oPaging.iTotalPages < iListLength) {
                iStart = 1;
                iEnd = oPaging.iTotalPages;
            } else if (oPaging.iPage <= iHalf) {
                iStart = 1;
                iEnd = iListLength;
            } else if (oPaging.iPage >= (oPaging.iTotalPages - iHalf)) {
                iStart = oPaging.iTotalPages - iListLength + 1;
                iEnd = oPaging.iTotalPages;
            } else {
                iStart = oPaging.iPage - iHalf + 1;
                iEnd = iStart + iListLength - 1;
            }

            for (i = 0, iLen = an.length; i < iLen; i++) {
                var wrapper = $(an[i]).parents(".dataTables_wrapper");

                if (oPaging.iTotal <= 0) {
                    $('.dataTables_paginate, .dataTables_length', wrapper).hide();
                } else {
                    $('.dataTables_paginate, .dataTables_length', wrapper).show();
                }

                if (oPaging.iTotalPages <= 0) {
                    $('.dataTables_paginate, .dataTables_length .seperator', wrapper).hide();
                } else {
                    $('.dataTables_paginate, .dataTables_length .seperator', wrapper).show();
                }

                $('.pagination-panel-total', an[i]).html(oPaging.iTotalPages);
                $('.pagination-panel-input', an[i]).val(oPaging.iPage + 1);

                // Remove the middle elements
                $('li:gt(1)', an[i]).filter(':not(.next)').remove();

                // Add the new list items and their event handlers
                for (j = iStart; j <= iEnd; j++) {
                    sClass = (j == oPaging.iPage + 1) ? 'class="active"' : '';
                    $('<li ' + sClass + '><a href="#">' + j + '</a></li>')
                        .insertBefore($('li.next:first', an[i])[0])
                        .bind('click', function (e) {
                            e.preventDefault();
                            oSettings._iDisplayStart = (parseInt($('a', this).text(), 10) - 1) * oPaging.iLength;
                            fnDraw(oSettings);
                        });
                }

                // Add / remove disabled classes from the static elements
                if (oPaging.iPage === 0) {
                    $('a.prev', an[i]).addClass('disabled');
                } else {
                    $('a.prev', an[i]).removeClass('disabled');
                }

                if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                    $('a.next', an[i]).addClass('disabled');
                } else {
                    $('a.next', an[i]).removeClass('disabled');
                }
            }
        }
    }
});
$.extend($.fn.dataTableExt.oPagination, {
    "bootstrap_four_icon": {
        "fnInit": function (oSettings, nPaging, fnDraw) {
            var oLang = oSettings.oLanguage.oPaginate;
            var oPaging = oSettings.oInstance.fnPagingInfo();

            var fnClickHandler = function (e) {
                e.preventDefault();
                if (oSettings.oApi._fnPageChange(oSettings, e.data.action)) {
                    fnDraw(oSettings);
                }
            };

            $(nPaging).append(
                '<div class="pagination-panel"> ' + oLang.page + ' ' +
                '<a href="#" class="btn btn-sm default first disabled" title="' + oLang.first + '"><i class="fa fa-angle-double-left"></i></a>' +
				'<a href="#" class="btn btn-sm default prev disabled" title="' + oLang.previous + '"><i class="fa fa-angle-left"></i></a>' +
                '<input type="text" class="pagination-panel-input form-control input-mini input-inline input-sm" maxlenght="5" style="text-align:center; margin: 0 5px;">' +
                '<a href="#" class="btn btn-sm default next disabled" title="' + oLang.next + '"><i class="fa fa-angle-right"></i></a> ' +
				'<a href="#" class="btn btn-sm default last disabled" title="' + oLang.last + '"><i class="fa fa-angle-double-right"></i></a> ' +
                oLang.pageOf + ' <span class="pagination-panel-total"></span>' +
                '</div>'
            );
			
            var els = $('a', nPaging);
			$(els[0]).bind('click.DT', {
                action: "first"
            }, fnClickHandler);
            $(els[1]).bind('click.DT', {
                action: "previous"
            }, fnClickHandler);
            $(els[2]).bind('click.DT', {
                action: "next"
            }, fnClickHandler);
			$(els[3]).bind('click.DT', {
                action: "last"
            }, fnClickHandler);
            $('.pagination-panel-input', nPaging).bind('change.DT', function (e) {
				
                var oPaging = oSettings.oInstance.fnPagingInfo();
                e.preventDefault();
                var page = parseInt($(this).val());
                if (page > 0 && page <= oPaging.iTotalPages) {
                    if (oSettings.oApi._fnPageChange(oSettings, page - 1)) {
                        fnDraw(oSettings);
                    }
                } else {
                    $(this).val(oPaging.iPage + 1);
                }
            });

            $('.pagination-panel-input', nPaging).bind('keypress.DT', function (e) {
                var oPaging = oSettings.oInstance.fnPagingInfo();
                if (e.which == 13) {
                    var page = parseInt($(this).val());
					
                    if (page > 0 && page <= oSettings.oInstance.fnPagingInfo().iTotalPages) {
                        if (oSettings.oApi._fnPageChange(oSettings, page - 1)) {
                            fnDraw(oSettings);
                        }
                    } else {
                        $(this).val(oPaging.iPage + 1);
                    }
                    e.preventDefault();
                }
            });
        },

        "fnUpdate": function (oSettings, fnDraw) {
            var iListLength = 5;
            var oPaging = oSettings.oInstance.fnPagingInfo();
            var an = oSettings.aanFeatures.p;
            var i, j, sClass, iStart, iEnd, iHalf = Math.floor(iListLength / 2);

            if (oPaging.iTotalPages < iListLength) {
                iStart = 1;
                iEnd = oPaging.iTotalPages;
            } else if (oPaging.iPage <= iHalf) {
                iStart = 1;
                iEnd = iListLength;
            } else if (oPaging.iPage >= (oPaging.iTotalPages - iHalf)) {
                iStart = oPaging.iTotalPages - iListLength + 1;
                iEnd = oPaging.iTotalPages;
            } else {
                iStart = oPaging.iPage - iHalf + 1;
                iEnd = iStart + iListLength - 1;
            }

            for (i = 0, iLen = an.length; i < iLen; i++) {
                var wrapper = $(an[i]).parents(".dataTables_wrapper");

                if (oPaging.iTotal <= 0) {
                    $('.dataTables_paginate, .dataTables_length', wrapper).hide();
                } else {
                    $('.dataTables_paginate, .dataTables_length', wrapper).show();
                }

                if (oPaging.iTotalPages <= 0) {
                    $('.dataTables_paginate, .dataTables_length .seperator', wrapper).hide();
                } else {
                    $('.dataTables_paginate, .dataTables_length .seperator', wrapper).show();
                }

                $('.pagination-panel-total', an[i]).html(oPaging.iTotalPages);
                $('.pagination-panel-input', an[i]).val(oPaging.iPage + 1);

                // Remove the middle elements
                $('li:gt(1)', an[i]).filter(':not(.next)').remove();

                // Add the new list items and their event handlers
                for (j = iStart; j <= iEnd; j++) {
                    sClass = (j == oPaging.iPage + 1) ? 'class="active"' : '';
                    $('<li ' + sClass + '><a href="#">' + j + '</a></li>')
                        .insertBefore($('li.next:first', an[i])[0])
                        .bind('click', function (e) {
                            e.preventDefault();
                            oSettings._iDisplayStart = (parseInt($('a', this).text(), 10) - 1) * oPaging.iLength;
                            fnDraw(oSettings);
                        });
                }

                // Add / remove disabled classes from the static elements
				if (oPaging.iPage === 0) {
                    $('a.first', an[i]).addClass('disabled');
                } else {
                    $('a.first', an[i]).removeClass('disabled');
                }
                if (oPaging.iPage === 0) {
                    $('a.prev', an[i]).addClass('disabled');
                } else {
                    $('a.prev', an[i]).removeClass('disabled');
                }

                if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                    $('a.next', an[i]).addClass('disabled');
                } else {
                    $('a.next', an[i]).removeClass('disabled');
                }
				if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                    $('a.last', an[i]).addClass('disabled');
                } else {
                    $('a.last', an[i]).removeClass('disabled');
                }
            }
        }
    }
});