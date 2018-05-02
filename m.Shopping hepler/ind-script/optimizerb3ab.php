/**
 * i18n - Javascript Internationalization System
 *
 * @author Platform Team
 */

(function() {
    var $i18n = {

        /**
         * Messages
         * @var array
         * {
         *     'DOMAIN NAME' : {
         *         'KEY NAME' : 'value',
         *         'KEY NAME(Plurals) : ['value', 'value', ...]
         *         ...
         *     },
         *     ...
         * }
         */
        _lang : {},

        /**
         * Plurals Expressions
         * @var array
         * {
         *     'DOMAIN NAME' : function(n) {
         *         expressions
         *     },
         *     ...
         * }
         */
        _pluralsExp : {},

        /**
         * Current Domain
         * @var string
         */
        _currDomain : false,

        /**
         * override the current domain for a single message lookup
         *
         * @param string domain
         * @param string key
         * @return string
         */
        __d : function(domain, key, __idx__) {

            var t = $i18n._lang;

            if ($i18n._isEmpty(t) === true) {
                return key;
            }

            if (typeof t[domain] == 'undefined') {
                return key;
            }

            if (typeof t[domain][key] == 'undefined') {
                return key;
            }

            if (typeof t[domain][key] == 'object') {
                __idx__ = __idx__ ? __idx__ : 0;
                return t[domain][key][__idx__];
            }

            return t[domain][key];

        },

        /**
         * Plural version of __d
         *
         * @param string domain
         * @param string key1
         * @param string key2
         * @param int cnt
         * @return string
         */
        __dn : function(domain, key1, key2, cnt) {

            var n = parseInt(cnt);
            var idx = $i18n._getPluralsIndex(domain, n);

            if (idx == 0) {
                return $i18n.__d(domain, key1, 0);
            } else {
                return $i18n.__d(domain, key2, idx);
            }
        },

        _init : function() {
            $i18n._pluralsExp.__reserved_default_exp__ = function(n) {
                return n == 1 ? 0 : 1;
            };

            window['__d'] = function(domain, key) {
                return $i18n.__d(domain, key, 0);
            };

            window['__dn'] = function(domain, key1, key2, cnt) {
                return $i18n.__dn(domain, key1, key2, cnt);
            };

            window['__'] = function(key) {
                return $i18n.__d($i18n._currDomain, key, 0);
            };

            window['__n'] = function(key1, key2, cnt) {
                return $i18n.__dn($i18n._currDomain, key1, key2, cnt);
            };

            window['__i18n_regist__']           = this._regist;
            window['__i18n_bind__']             = this._bind;
            window['__i18n_plurals_exp_bind__'] = this._pluralsExpBind;
        },

        _isEmpty : function(val) {

            if (!val) return true;
            if (val == null) return true;
            if (val == undefined) return true;
            if (val == '') return true;
            if (typeof val == 'object') {
                for (var i in val) {
                    return false;
                }

                return true;
            }

            return false;

        },

        _trim : function(str) {
            if(typeof str != 'string') return '';

            return str.replace(/(^\s*)|(\s*$)/g, '');
        },

        _apply : function(method, func) {

            this[method] = func;

        },

        _regist : function(lang) {

            if (typeof lang != 'object') return false;

            $i18n._lang = lang;

            return true;

        },

        _bind : function(domain) {

            if ($i18n._isEmpty(domain) === true) return false;

            $i18n._currDomain = domain;

            return true;

        },

        _pluralsExpBind : function(domain, exp) {
            if (typeof exp != 'function') {
                return;
            }

            $i18n._pluralsExp[domain] = exp;
        },

        _getPluralsIndex : function(domain, n) {
            if (typeof $i18n._pluralsExp[domain] == 'undefined') {
                return $i18n._pluralsExp.__reserved_default_exp__(n);
            }

            return $i18n._pluralsExp[domain](n);
        }
    };

    $i18n._init();
})();
__i18n_regist__({"front":{"__VERSION__":"201"}});__i18n_bind__("front");
/*
* php의 sprintf와 사용방법은 비슷하나 문자열 포멧의 type specifier는 %s만 사용
* 참조 : http://wiki.simplexi.com/pages/viewpage.action?pageId=125338699
*/
function sprintf()
{
    var pattern = /%([0-9]+)\$s/g;
    
    var text = arguments[0];
    var extract = text.match(pattern, text);

    if (extract == null || extract.length < 0) {
        var split = text.split('%s');
        var count = split.length;
        var tmp = new Array();
        
        for (var i = 0; i < count; i++) {
            if (typeof arguments[i + 1] != 'undefined') {
                tmp.push(split[i] + arguments[i + 1]);
            } else {
                tmp.push(split[i]);
            }
        }
        
        return tmp.join('');
    } else {
        var count = extract.length;
        
        for (var i = 0; i < count; i++) {
            var index = extract[i].replace(pattern, '$1');
            if (typeof arguments[index] != 'undefined') {
                text = text.replace('%' + index + '$s', arguments[index]);
            }
        }
        
        return text;
    }
}
/*
 * 각개체 별 항목 컨트롤 을 위해서 차후 확장을 고려 하여 별도로 추출
 * 
 */

secondZipcodeHidden();

function secondZipcodeHidden () {
    
    //Front Page 우편번호 2번째 엘레멘트 리스트
    var secondZipcodeElementId = new Array (
            "postcode2",
            "rzipcode2",
            "ozipcode2",
            "zip2",
            "address_zip2"
            );

    for (var i in secondZipcodeElementId) {
        try {
            document.getElementById(secondZipcodeElementId[i]).style.display = "none";
        } catch (e){ }
    }

    // 구디자인 회원 가입수정 zip2 제거
    try {
        document.frm.zip2.style.display = "none";
    } catch (e) { }

    // 구디자인 배송목록 zip2 제거
    try {
        document.addr_set.rcv_zipcode2.style.display = "none";
    } catch (e) { }

    // 구디자인 주문서 작성 zip2 제거
    try {
        document.frm.rzipcode2.style.display = "none";
        document.frm.ozipcode2.style.display = "none";
    } catch (e) { }

    // 구디자인 세금계산서 신청약식 zip2 제거
    try {
        document.frm.mall_zipcode2.style.display = "none";
    } catch (e) { }
}

var EC_FRONT_XANS_INTERPRETER = (function() {
    // 변수 정규표현식
    var XANS_VAR_FULL_NAME_REGEXP = '\\{\\$([a-z0-9_\\.]+)(?:[\\s]*[\\|][\\s]*([a-z0-9]+)[\\s]*[:]?((?:[^\\{\\}]+)*))?\\}';

    // 템플릿에서 모든 변수를 찾기 위한 정규식
    var regexpFindSDEVarFullName = new RegExp(XANS_VAR_FULL_NAME_REGEXP, 'ig');

    // '{$var_name|display}'과 같은 문자열에서 변수명과 모디파이어를 분리하기 위한 정규식
    var regexpSDEVarFullname = new RegExp('^' + XANS_VAR_FULL_NAME_REGEXP + '$', 'i');

    // 모디파이어
    var aSDEModifier = {
        display: function(sVar)
        {
            if (sVar) {
                return '';
            } else{
                return 'displaynone';
            }
        },
        numberformat: function(sVar)
        {
            if (isFinite(sVar)) {
                return number_format(sVar);
            } else {
                return '';
            }
        }
    };

    /**
     * 숫자를 3자리씩 콤마(,)로 끊어서 문자열로 변환하여 리턴합니다.
     * @param string sNumber 숫자
     * @returns {string} 콤마 반영된 문자열
     */
    function number_format(sNumber)
    {
        // 3자리씩 ,로 끊어서 리턴
        var sNumber = String(parseInt(sNumber));
        var regexp = /^(-?[0-9]+)([0-9]{3})($|\.|,)/;
        while (regexp.test(sNumber)) {
            sNumber = sNumber.replace(regexp, "$1,$2$3");
        }
        return sNumber;
    }

    /**
     * 전체 변수명에서 실제 변수명과 모디파이어 등을 분리하여 리턴합니다.
     * @param string sVarFullName '{$var_name|display}' 형태의 전체 변수명
     * @returns {{var_name: *, modifire: *}}
     */
    function parseVariableInfo(sVarFullName)
    {
        var aMatches = sVarFullName.match(regexpSDEVarFullname);

        return {
            var_name: aMatches[1],
            modifire: aMatches[2]
        };
    }

    /**
     * XANS 템플릿에서 변수를 반영하여 리턴합니다.
     * @param string sTemplate 템플릿 (HTML)
     * @param array aVars 변수 리스트
     * @return string 완성된 HTML
     */
    function fetch(sTemplate, aVars)
    {
        var aHtml = sTemplate.split('<!--#-->');
        var sHtml = '';

        $(aHtml).each(function(iIndex, sModuleHtml) {
            if (iIndex < 1 || (iIndex % 2) !== 1) {
                sHtml += convertHtmlVars(sModuleHtml, aVars);
            } else {
                var oObj = $(sModuleHtml);
                var sChildNode = $('<div>').append(oObj.find(':first-child').clone()).html();

                var sModuleClass = $(oObj).attr('class');
                var sModuleName = ucfirst(sModuleClass.match(/xans-product-([^- ]+)/)[1]);

                if (typeof(aVars['@' + sModuleName]) === 'object') {
                    var s = '';
                    $(aVars['@' + sModuleName]).each(function(i, aData) {
                        s += convertHtmlVars(sChildNode, aData);
                    });

                    if (s !== '') {
                        sHtml += $('<div>').append(oObj.html(s).clone()).html();
                    }
                }
            }
        });

        return sHtml;
    }

    function ucfirst(sString)
    {
        if (typeof(sString) !== 'string') {
            return '';
        }
        return sString.substring(0, 1).toUpperCase() + sString.substring(1).toLowerCase();
    }

    function convertHtmlVars(sTemplate, aVars)
    {
        return sTemplate.replace(regexpFindSDEVarFullName, function(sVarFullName) {
            var aVarInfo = parseVariableInfo(sVarFullName);

            var sValue = '';
            if (aVars[aVarInfo.var_name] || aVars[aVarInfo.var_name] === 0) {
                sValue = aVars[aVarInfo.var_name];
            }

            if (aVarInfo.modifire !== undefined && aSDEModifier.hasOwnProperty(aVarInfo.modifire) === true) {
                return aSDEModifier[aVarInfo.modifire](sValue);

            } else {
                return sValue;

            }
        });
    }

    /**
     * XANS 템플릿에서 변수 리스트를 얻어서 리턴합니다.
     * @param string sTemplate 템플릿 (HTML)
     * @return array 변수 리스트 (ex: ['{$var_name}', '{$var_name|display}'])
     */
    function getVariables(sTemplate)
    {
        return sTemplate.match(regexpFindSDEVarFullName);
    }

    return {
        getVariables: getVariables,
        parseVariableInfo: parseVariableInfo,
        fetch: fetch
    };
})();
var EC_FRONT_XANS_TEMPLATE = (function() {
    // 모듈별 템플릿
    var aModuleTemplates = {};

    /**
     * 모듈별 템플릿을 셋팅합니다.
     * @param string sModuleName 모듈명 (xans-product-listmain-1)
     * @param string sModuleTemplate 모듈 템플릿
     */
    function setTemplate(sModuleName, sModuleTemplate)
    {
        aModuleTemplates[sModuleName] = sModuleTemplate;

        if (/^xans-product-list|^xans-product-hashtaglist/.test(sModuleName) === true) {
            var sTemplateForVDOM = getTemplateForVDOM(sModuleName);
            var $li = $(sTemplateForVDOM).find('li:first');
            var sLiHTMLForVDOM = $('<ul>').append($li).html();

            // 해시태그 모듈에 대한 별도 캐싱 처리
            if (/^xans-product-hashtaglist/.test(sModuleName) === true) {
                aModuleTemplates[sModuleName] = convertVDomHtmlToHTML(sLiHTMLForVDOM);
            } else {
                // oMobileDomData를 여전히 사용중인 사용자js와의 호환성을 위한 예외처리 - ECHOSTING-142586
                window.oMobileDomData = {
                    dom: convertVDomHtmlToHTML(sLiHTMLForVDOM),
                    data: EC_FRONT_XANS_INTERPRETER.getVariables(sLiHTMLForVDOM)
                };
            }
        }
    }

    /**
     * 모듈별 템플릿을 가져옵니다.
     * @param string sModuleName 모듈명
     * @return string 모듈별 템플릿
     */
    function getTemplate(sModuleName)
    {
        if (aModuleTemplates.hasOwnProperty(sModuleName)) {
            return aModuleTemplates[sModuleName];
        } else {
            return undefined;
        }
    }

    /**
     * Virtual DOM 에서 사용할 모듈별 템플릿을 가져옵니다.
     * @param string sModuleName 모듈명
     * @return string 모듈별 템플릿
     */
    function getTemplateForVDOM(sModuleName)
    {
        var sTemplate = getTemplate(sModuleName) || '';

        // src 속성에 대해 "//:0" 처리해줍니다.
        var sTemplateForVDOM = sTemplate.replace(/(\s+src\s*=\s*["'])/g, '$1//:0#xansjs');

        return sTemplateForVDOM;
    }

    /**
     * "Virtual DOM"용 HTML을 일반 HTML로 변환하여 리턴합니다.
     * @param string sTemplateForVDOM "Virtual DOM"용 사용한 템플릿 HTML
     * @return string 일반 HTML
     */
    function convertVDomHtmlToHTML(sTemplateForVDOM)
    {
        // src 속성에서 "//:0#xansjs"를 삭제합니다.
        var sTemplate = sTemplateForVDOM.replace(/(\s+src\s*=\s*["'])\/\/:0#xansjs/g, '$1');

        return sTemplate;
    }

    return {
        setTemplate: setTemplate,
        getTemplate: getTemplate,
        getTemplateForVDOM: getTemplateForVDOM,
        convertVDomHtmlToHTML: convertVDomHtmlToHTML
    };

})();
/**
 * 모바일 전용 Util
 * @package app/Mobile
 * @subpackage Front/Disp/Product
 * @version 1.0
 */

var EC_MOBILE_UTIL = {
    /*
     * get li
     */
    convertNode : function(node) {
        return EC_FRONT_XANS_INTERPRETER.fetch(oMobileDomData.dom, node);
    },

    /*
     * set default img
     */
    setDefaultImage : function(string, orgStr, repStr) {
        $(".thumbnail img,img.ThumbImage,img.BigImage").each(function($i,$item){
            var $img = new Image();
            $img.onerror = function () {
                    $item.src="//img.echosting.cafe24.com/thumb/img_product_big.gif";
            }
            $img.src = this.src;
        });
    },

    /*
     * get ajax url
     */
    getAjaxUrl : function(sModule) {
        var aAjax = [];

        aAjax['xans-product-listnormal'] = '/exec/front/Product/ApiProductNormal';
        aAjax['xans-product-listmain'] = '/exec/front/Product/ApiProductMain';

        return aAjax[sModule];
    },

    /*
     * set param
     */
    setAjaxParam : function(aData, sModule) {
        var aParam = [];

        if (typeof(aData['cate_no']) === 'number' && aData['cate_no'] > 0) { aParam.push('cate_no=' + aData['cate_no']); }
        if (typeof(aData['display_group']) === 'number' && aData['display_group'] > 0) { aParam.push('display_group=' + aData['display_group']); }
        if (typeof(aData['sort_method']) === 'number' && aData['sort_method'] > 0) { aParam.push('sort_method=' + aData['sort_method']); }
        if (typeof(aData['supplier_code']) === 'string' && aData['supplier_code'] !== '') { aParam.push('supplier_code=' + aData['supplier_code']); }
        if (typeof(aData['ec_soldout_display']) === 'string' && aData['ec_soldout_display'] !== '') { aParam.push('ec_soldout_display=' + aData['ec_soldout_display']); }
        aParam.push('page=' + aData['page']);
        aParam.push('bInitMore=' + aData['bInitMore']);
        aParam.push('count=' + aData['count']);

        return this.getAjaxUrl(sModule) + '?' + aParam.join('&');
    }
};



/*
 * Swipe 1.0
 *
 * Brad Birdsall, Prime
 * Copyright 2011, Licensed GPL & MIT
 *
*/
;window.SwipeClient = function(element, options) {
    // return immediately if element doesn't exist
    if (! element) {
        return null;
    }

    var _this = this;

    // retreive options
    this.options = options || {};
    this.index = this.options.startSlide || 0;
    this.speed = this.options.speed || 300;
    this.callback = this.options.callback || function() {};
    this.delay = this.options.auto || 0;
    this.postback = this.options.postback || true;

    // 캐싱 사용유무 (기본값으로 이미 넘어오지만 그래도 no로 한번 더 저장)
    this.cache = this.options.cache || 'no';

    // 현재 슬라이드 개별 모듈의 순서(인덱스)를 저장하기 위해 저장 (상품번호, 카테코리 번호 등으로 조합된 상품별 유니크 값)
    this.storageId = this.options.elementId || '';

    // reference dom elements
    this.container = element;
    this.element = this.container.getElementsByTagName('ul')[0]; // the slide pane

    // static css
    this.container.style.overflow = 'hidden';
    this.element.style.listStyle = 'none';
    this.element.style.margin = 0;

    // trigger slider initialization
    this.setup();

    // begin auto slideshow
    this.begin();

    // add event listeners
    if (this.element.addEventListener) {
        this.element.addEventListener('touchstart', this, false);
        this.element.addEventListener('touchmove', this, false);
        this.element.addEventListener('touchend', this, false);
        this.element.addEventListener('touchcancel', this, false);
        this.element.addEventListener('webkitTransitionEnd', this, false);
        this.element.addEventListener('msTransitionEnd', this, false);
        this.element.addEventListener('oTransitionEnd', this, false);
        this.element.addEventListener('transitionend', this, false);

        window.addEventListener('resize', this, false);
    }
};

SwipeClient.prototype = {
    setup: function() {
        // get and measure amt of slides
        this.slides = this.element.children;
        this.length = this.slides.length;

        // return immediately if their are less than two slides
        if (this.length < 2) {
            return null;
        }

        // determine width of each slide
        this.width = Math.ceil(('getBoundingClientRect' in this.container) ? this.container.getBoundingClientRect().width : this.container.offsetWidth);

        // Fix width for Android WebView (i.e. PhoneGap)
        if (this.width === 0 && typeof window.getComputedStyle === 'function') {
            this.width = window.getComputedStyle(this.container, null).width.replace('px','');
        }

        // return immediately if measurement fails
        if (! this.width) {
            return null;
        }

        // hide slider element but keep positioning during setup
        var origVisibility = this.container.style.visibility;

        this.container.style.visibility = 'hidden';

        // dynamic css
        this.element.style.width = Math.ceil(this.slides.length * this.width) + 'px';

        var index = this.slides.length;

        while (index--) {
            var el = this.slides[index];

            el.style.width = this.width + 'px';
            el.style.display = 'table-cell';
            el.style.verticalAlign = 'top';
        }

        // set start position and force translate to remove initial flickering

        // 캐싱 사용중일 경우에만 처리
        if (this.cache === 'yes') {
            // 저장된 세선 스토리지 읽어와 처리
            // 각 스와이프의 개별 모듈에 해당되는 세션 스토리지 값
            // NaN 보다는 parseInt(null)로 명확하게 구분
            var iStorageIndexData = parseInt(null);

            // 상품 상세페이지에서 생성된 세션 스토리지 키
            var sStorageDetailName = 'sStorageDetail';

            // 상품 상세페이지에서 생성된 세션 스토리지 값 (Unix Timestamp)
            // NaN 보다는 parseInt(null)로 명확하게 구분
            var iStorageDetailData = parseInt(null);

            // 현재 시간 Unix Timstamp
            var iNowTime = Math.floor(new Date().getTime() / 1000);

            // 세션 스토리지 유지 시간
            var iSessionTime = 60 * 5;

            // 값 할당 (int)
            try {
                iStorageIndexData = parseInt(sessionStorage.getItem(this.storageId));
                iStorageDetailData = parseInt(sessionStorage.getItem(sStorageDetailName));
            } catch (e) {
            }

            // 저장된 값(추가 이미지)이 삭제된 경우 빈 페이지로 스와이프 되므로, 저장된 인덱스에 해당되는 이미지가 없는 경우는 세션 스토리지 삭제
            if (typeof($S.aButton[iStorageIndexData]) === 'undefined') {
                // 할당된 값 초기화
                iStorageIndexData = parseInt(null);

                // 실제 세션 스토리지에서도 삭제
                try {
                    sessionStorage.removeItem(this.storageId);
                } catch (e) {
                }
            }

            // 값이 있다면 moveTab을 해야 Circle(페이징 원)까지 변경됨
            // 상세페이지에서 생성된 세션 스토리지가 특정 시간이 경과하지 않은 경우에만 처리
            // 만약 모듈에서 상품번호 등의 정보(this.storageId)를 가져오지 못한 경우에는 처리하지 않음
            if (this.storageId !== '' && isNaN(iStorageIndexData) === false && isNaN(iStorageDetailData) === false && iStorageDetailData + iSessionTime >= iNowTime) {
                // 실제 이동 처리
                this.moveTab(iStorageIndexData, 0);
            } else {
                this.slide(this.index, 0);
            }
        } else {
            this.slide(this.index, 0);
        }

        this.container.style.visibility = origVisibility;
    },

    slide: function(index, duration) {
        // if useing ajax load
        try {
            if (oMobileSliderData.sPictorialLoad === true) {
                if ($S.iAjax === index + 1 && $S.bAjax === true) {
                    $S.callAjax();
                }
            }
        } catch (e) {}

        var style = this.element.style;

        // fallback to default speed
        if (duration == undefined) {
          duration = this.speed;
        }

        // set duration speed (0 represents 1-to-1 scrolling)
        style.webkitTransitionDuration = style.MozTransitionDuration = style.msTransitionDuration = style.OTransitionDuration = style.transitionDuration = duration + 'ms';

        // translate to given index position
        style.MozTransform = style.webkitTransform = 'translate3d(' + -(index * this.width) + 'px, 0, 0)';
        style.msTransform = style.OTransform = 'translateX(' + -(index * this.width) + 'px)';

        // set new index to allow for expression arguments
        this.index = index;

        // 현재 모듈의 인덱스를 세선 스토리지에 저장
        // 캐시 사용중이며 인덱스가 있으면서 저장할 스토리지 ID 값이 있는 경우에만 처리
        if (this.cache === 'yes' && isNaN(this.index) === false && this.storageId !== '') {
            try {
                sessionStorage.setItem(this.storageId, this.index);
            } catch (e) {
            }
        }
    },

    getPos: function() {
        // return current index position
        return this.index;
    },

    prev: function(delay, postback) {
        // cancel next scheduled automatic transition, if any
        this.delay = delay || 0;
        this.postback = (postback == undefined) ? true : postback;

        clearTimeout(this.interval);

        if (this.index) {
            this.slide(this.index - 1, this.speed);
        } else {
            if (this.postback !== false) {
                this.slide(this.length - 1, this.speed); //if first slide return to end
            }
        }
    },

    next: function(delay, postback) {
        // cancel next scheduled automatic transition, if any
        this.delay = delay || 0;
        this.postback = (postback == undefined) ? true : postback;

        clearTimeout(this.interval);

        if (this.index < this.length - 1) {
            this.slide(this.index + 1, this.speed);
        } else {
            if (this.postback !== false) {
                this.slide(0, this.speed); //if last slide return to start
            }
        }
    },

    moveTab: function(iPage, delay) {
        // control current tab action
        // 모바일 상품상세에서 slide영역을 다시 원복함
        this.index = iPage;
        this.delay = delay || 0;

        clearTimeout(this.interval);

        this.slide(this.index, this.speed);

        if (typeof(EC_SHOP_FRONT_NEW_OPTION_EXTRA_IMAGE) !== 'undefined') {
            EC_SHOP_FRONT_NEW_OPTION_EXTRA_IMAGE.setSwipeImage('', true, iPage);
        }
    },

    begin: function() {
        var _this = this;

        this.interval = (this.delay) ? setTimeout(function() {
            _this.next(_this.delay);
        }, this.delay) : 0;
    },

    stop: function() {
      this.delay = 0;

      clearTimeout(this.interval);
    },

    resume: function() {
      this.delay = this.options.auto || 0;
      this.begin();
    },

    setLength: function(expand) {
        this.length = expand;
    },

    handleEvent: function(e) {
        switch (e.type) {
            case 'touchstart':
                this.onTouchStart(e);
                break;
            case 'touchmove':
                this.onTouchMove(e);
                break;
            case 'touchcancel':
            case 'touchend':
                this.onTouchEnd(e);
                break;
            case 'webkitTransitionEnd':
            case 'msTransitionEnd':
            case 'oTransitionEnd':
            case 'transitionend':
                this.transitionEnd(e);
                break;
            case 'resize':
                this.setup();
                break;
        }
    },

    transitionEnd: function(e) {
      if (this.delay) {
          this.begin();
      }

      this.callback(e, this.index, this.slides[this.index], this);
    },

    onTouchStart: function(e) {
        this.start = {
          // get touch coordinates for delta calculations in onTouchMove
          pageX: e.touches[0].pageX,
          pageY: e.touches[0].pageY,

          // set initial timestamp of touch sequence
          time: Number(new Date())
        };

        // used for testing first onTouchMove event
        this.isScrolling = undefined;

        // reset deltaX
        this.deltaX = 0;

        // set transition time to 0 for 1-to-1 touch movement
        this.element.style.MozTransitionDuration = this.element.style.webkitTransitionDuration = 0;

        e.stopPropagation();
    },

    onTouchMove: function(e) {
        // ensure swiping with one touch and not pinching
        if (e.touches.length > 1 || e.scale && e.scale !== 1) {
            return;
        }

        this.deltaX = e.touches[0].pageX - this.start.pageX;

        // determine if scrolling test has run - one time test
        if (typeof this.isScrolling == 'undefined') {
            this.isScrolling = !! (this.isScrolling || Math.abs(this.deltaX) < Math.abs(e.touches[0].pageY - this.start.pageY));
        }

        // if user is not trying to scroll vertically
        if (! this.isScrolling) {
            // prevent native scrolling
            e.preventDefault();

            // cancel slideshow
            clearTimeout(this.interval);

            // increase resistance if first or last slide
            this.deltaX =
            this.deltaX /
            ((! this.index && this.deltaX > 0            // if first slide and sliding left
            || this.index == this.length - 1            // or if last slide and sliding right
            && this.deltaX < 0                          // and if sliding at all
            ) ?
            (Math.abs(this.deltaX) / this.width + 1)    // determine resistance level
            : 1);                                       // no resistance if false

            // translate immediately 1-to-1
            this.element.style.MozTransform = this.element.style.webkitTransform = 'translate3d(' + (this.deltaX - this.index * this.width) + 'px,0,0)';

            e.stopPropagation();
        }
    },

    onTouchEnd: function(e) {
        // determine if slide attempt triggers next/prev slide
        var isValidSlide =
            Number(new Date()) - this.start.time < 250      // if slide duration is less than 250ms
            && Math.abs(this.deltaX) > 20                   // and if slide amt is greater than 20px
            || Math.abs(this.deltaX) > this.width/2,        // or if slide amt is greater than half the width

        // determine if slide attempt is past start and end
        isPastBounds =
            ! this.index && this.deltaX > 0                          // if first slide and slide amt is greater than 0
            || this.index == this.length - 1 && this.deltaX < 0;    // or if last slide and slide amt is less than 0

        // if not scrolling vertically
        if (! this.isScrolling) {
            // call slide function with slide end value based on isValidSlide and isPastBounds tests
            this.slide(this.index + (isValidSlide && ! isPastBounds ? (this.deltaX < 0 ? 1 : -1) : 0 ), this.speed);
        }

        e.stopPropagation();
    }
};

/**
 * 모바일 상품 더보기 모듈
 * @package app/Mobile
 * @subpackage Front/Disp/Product
 * @version 2.2
 *
 *
 * version 2.2 변경사항
 * 1. cache = yes 설정으로 더보기 리스트 유지
 * 2. 사용자 html 수정 유무에 상관없이 리스팅
 * 3. api에 $review_cnt 추가
 */
var $M = {
    /*
     * current module name
     */
    sModule : 'xans-product-listnormal',
    /*
     * current module name
     */
    sMore : 'xans-product-listmore',

    /*
     * 더보기 버튼에 대한 중복 실행을 막기 위한 flag
     */
    bLoading : false,

    /*
     * 모듈별로 object 값
     */
    oModuleLoading : {},

    /*
     * init
     */
    init : function() {
        if (this.sModule == 'xans-product-listnormal') {
            // 일반상품에 대해 더보기 기능 적용시 페이징 모듈 자동 삭제
            $('.xans-product-normalpaging').remove();
        }
    },
    /*
     * show more
     * @param int iActive 모듈 key
     * @param int iDisplayGroup 추천/신상품 분류
     * @param int iCategoryNo 카테고리 번호
     * @param int iCount 주석변수 상품 수
     * @param int iSortMethod 정렬방법
     * @param string sSupplierCode 공급사코드
     * @param bool bInitMore 더보기 기능 초기화 여부
     * @param string 품절상품 표시 여부
     */
    displayMore : function(iActive, iDisplayGroup, iCategoryNo, iCount, iSortMethod, bCache, sSupplierCode, bInitMore, sSoldoutDisplay) {

        if (this.oModuleLoading[iDisplayGroup] === true) {
            // 로딩 중에는 실행 안함
            return;
        }

        var EC_MORE = (function() {
            var sTargetModuleName,
                sLiTemplate,
                sFirstLiTemplate,
                $moreButton,
                $currentPageText,
                sCurrentPageCookieName,
                iRequestPageNum;

            /**
             * 추가될 상품 정보가 append될 모듈명
             * @returns {string}
             */
            function getTargetModuleName()
            {
                if (iActive > 0) {
                    return $M.sModule + '-' + iActive;
                } else {
                    return $M.sModule;
                }
            }
            /**
             * LI 템플릿을 리턴합니다.
             * @returns {string}
             */
            function getLiTemplate(sPos)
            {
                var sModuleHtmlForVDOM = EC_FRONT_XANS_TEMPLATE.getTemplateForVDOM(sTargetModuleName);
                var $li = $(sModuleHtmlForVDOM).find('ul:first > li:'+sPos);
                var sLiHtmlForVDOM = $('<ul>').append($li).html();

                return EC_FRONT_XANS_TEMPLATE.convertVDomHtmlToHTML(sLiHtmlForVDOM);
            }
            /**
             * "더보기" 버튼 모듈
             * @returns {jQuery}
             */
            function getMoreButtonElement()
            {
                if (iActive > 0) {
                    return $('.' + $M.sMore + '-' + iActive);
                } else {
                    return $('.' + $M.sMore);
                }
            }
            /**
             * "현재페이지 표시" 영역
             * @returns {jQuery}
             */
            function getCurrentPageTextElement()
            {
                if (iDisplayGroup > 1) {
                    return $('#more_current_page_' + iDisplayGroup);
                } else {
                    return $('#more_current_page');
                }
            }
            /**
             * "캐쉬된 현재페이지" 쿠키명
             * @returns {string}
             */
            function getCachedCurrentPageCookieName()
            {
                var aCookieName = ['mobile_more_current_page'];
                if (iCategoryNo > 0) {
                    aCookieName.push(iCategoryNo);
                }
                if (iDisplayGroup > 1) {
                    aCookieName.push(iDisplayGroup);
                }
                return aCookieName.join('_');
            }
            /**
             * 요청할 페이지 번호를 구하여 리턴합니다.
             * @return int
             *      "더보기 유지 기능 사용" + "더보기 초기화"인 경우 현재 쿠키에 저장된 페이지 번호
             *      그 외에는 다음에 가져올 페이지 번호
             */
            function getRequestPageNum()
            {
                if (bCache === true && bInitMore === true) {
                    // "더보기 유지 기능 사용" + "더보기 초기화"인 경우
                    var sCookieCurrentPage = $.cookie(sCurrentPageCookieName);

                    if (sCookieCurrentPage) {
                        return parseInt(sCookieCurrentPage, 10);
                    } else {
                        return 1;
                    }

                } else {
                    // 그 외
                    var iCurrentPage = $moreButton.data('current_page');

                    if (iCurrentPage === undefined) {
                        iCurrentPage = 1;
                    }

                    return iCurrentPage + 1;
                }
            }
            /**
             * 다음 페이지 상품 정보를 가져올 수 있는 ajax URL을 리턴합니다.
             * @returns string
             */
            function getAjaxUrl()
            {

                var aParam = {
                    cate_no : iCategoryNo,
                    display_group : iDisplayGroup,
                    supplier_code : sSupplierCode,
                    sort_method : iSortMethod,
                    page : iRequestPageNum,
                    count : iCount,
                    bInitMore : (bInitMore === true) ? 'T' : 'F',
                    ec_soldout_display : sSoldoutDisplay
                };

                return EC_MOBILE_UTIL.setAjaxParam(aParam, $M.sModule);
            }
            /**
             * 다음 페이지 상품 정보를 UL Element에 추가해줍니다.
             * @param array aData 상품 정보
             */
            function appendMoreData(aData)
            {
                var aHtml = [];
                var sTemplate = sLiTemplate;
                $(aData).each(function(iIndex, aVar) {
                    if (iIndex === 0) {
                        sTemplate = sFirstLiTemplate;
                    } else {
                        sTemplate = sLiTemplate;
                    }
                    aHtml.push(EC_FRONT_XANS_INTERPRETER.fetch(sTemplate, aVar));
                });
                var sHtml = aHtml.join('');

                $('.' + sTargetModuleName).each(function() {
                    $(this).find('ul:first').append(sHtml);
                });

                $currentPageText.text(iRequestPageNum);
                $moreButton.data('current_page', iRequestPageNum);

                // 캐시 기능 사용이면 쿠키에 현재 페이지 저장
                if (bCache === true) {
                    $.cookie(sCurrentPageCookieName, iRequestPageNum, { expires: 1 });
                }
            }
            /**
             * '더보기' 버튼을 숨김 처리합니다.
             */
            function hideMoreButton()
            {
                $moreButton.remove();
            }

            /**
             * Ajax 요청 여부를 리턴합니다.
             * @return bool true이면 ajax 요청, false이면 ajax 요청 안함
             */
            function isCallAjax()
            {
                if (bInitMore === true && iRequestPageNum <= 1) {
                    // 더보기 유지 기능 동작이고 iRequestPageNum 값이 1이하이면 요청 안함
                    return false;
                }

                return true;
            }

            function setMoreAction(data)
            {
                if (data.rtn_data.end === true) {
                    EC_MORE.hideMoreButton();
                }

                if (data.is_new_product === true) {
                    EC_SHOP_FRONT_REVIEW_TALK_REVIEW_COUNT.setReviewTalkCnt();
                }
            }

            sTargetModuleName = getTargetModuleName();
            sFirstLiTemplate = getLiTemplate('first');
            sLiTemplate = getLiTemplate('last');
            $moreButton = getMoreButtonElement();
            $currentPageText = getCurrentPageTextElement();
            sCurrentPageCookieName = getCachedCurrentPageCookieName();
            iRequestPageNum = getRequestPageNum();

            return {
                isCallAjax: isCallAjax,
                getAjaxUrl: getAjaxUrl,
                appendMoreData: appendMoreData,
                hideMoreButton: hideMoreButton,
                setMoreAction: setMoreAction
            };
        })();

        // ajax
        if (EC_MORE.isCallAjax() === true) {

            var aParamData = {};
            if ($('#ec-product-searchdata-form').length > 0 ) {

                $('#ec-product-searchdata-catenum').val(iCategoryNo);
                EC_FRONT_PRODUCT_SEARCH_DATA.setSearchPriceData();

                $('#ec-product-searchdata-form .ec-product-searchdata-form:checked').each(function(idx) {
                    $(this).val(encodeURIComponent($(this).val()));
                });

                aParamData = $('#ec-product-searchdata-form').serialize();

                $('#ec-product-searchdata-form .ec-product-searchdata-form:checked').each(function(idx) {
                    $(this).val(decodeURIComponent($(this).val()));
                });
            }

            var iGetCategory = iCategoryNo;
            var iGetDisplay = iDisplayGroup;

            if (iGetCategory === 0) {
                iGetCategory = 1;
            }

            if (iGetDisplay === 0) {
                iGetDisplay = 1;
            }

            // 저장된 세선 스토리지 읽어와 처리
            // 각 더보기의 개별 모듈에 해당되는 세션 스토리지 키
            var sStorageListName = 'sStorageList_' + iGetCategory + '_' + iGetDisplay;

            // 각 더보기의 개별 모듈에 해당되는 세션 스토리지 값
            var sStorageListData = null;

            // 상품 상세페이지에서 생성된 세션 스토리지 키
            var sStorageDetailName = 'sStorageDetail';

            // 상품 상세페이지에서 생성된 세션 스토리지 값 (Unix Timestamp)
            var sStorageDetailData = null;

            // 현재 시간 Unix Timstamp
            var iNowTime = Math.floor(new Date().getTime() / 1000);

            // 세션 스토리지 유지 시간
            var iSessionTime = 60 * 5;

            try {
                sStorageListData = sessionStorage.getItem(sStorageListName);
                sStorageDetailData = sessionStorage.getItem(sStorageDetailName);
            } catch (e) {
            }

            // 상세페이지에서 생성된 세션 스토리지가 특정 시간이 경과하지 않은 경우에만 캐싱 데이터 사용
            if (sStorageDetailData !== null && parseInt(sStorageDetailData) + iSessionTime >= iNowTime) {
                if (bInitMore === true && sStorageListData !== null) {
                    var oReturnData = JSON.parse(sStorageListData);

                    EC_MORE.appendMoreData(oReturnData.rtn_data.data);
                    EC_MORE.setMoreAction(oReturnData);

                    return;
                }
            }

            $.ajax({
                type: 'get',
                url: EC_MORE.getAjaxUrl(),
                data: aParamData,
                dataType: 'json',
                success: function(data) {
                    if (data.rtn_code === '1000') {
                        EC_MORE.appendMoreData(data.rtn_data.data);
                        EC_MORE.setMoreAction(data);

                        // 초기 구동이 아니면서 세션 스토리지에 데이터가 있는 경우에는 append
                        if (bInitMore === false && sStorageListData !== null) {
                            data.rtn_data.data = JSON.parse(sStorageListData).rtn_data.data.concat(data.rtn_data.data);
                        }

                        // 최종 생성된 데이터 세션 스토리지에 저장
                        try {
                            sessionStorage.setItem(sStorageListName, JSON.stringify(data));
                        } catch (e) {
                        }
                    } else {
                        alert('상품을 추가로 더 불러오는 과정에 문제가 발생했습니다. 지속적으로 발생할 경우 운영자에게 문의하세요.');

                        EC_MORE.hideMoreButton();

                        return false;
                    }
                },
                error: function (xhr, status, error) {
                    return false;
                },
                beforeSend: function () {
                    $M.oModuleLoading[iDisplayGroup] = true;
                },
                complete: function () {
                    $M.oModuleLoading[iDisplayGroup] = false;
                }
            });
        }
    } ,
    setDisplayPageMore : function(iActive, iDisplayGroup, iCategoryNo, iCount, iSortMethod, bCache, sSupplierCode, bInitMore, sSoldoutDisplay) {
        this.displayMore(iActive, iDisplayGroup, iCategoryNo, iCount, iSortMethod, bCache, sSupplierCode, true, sSoldoutDisplay);
    }
};
/**
 * 모바일 상품 스와이프 모듈
 * @package app/Shop
 * @subpackage Front/Disp/Product
 * @since 2014. 2. 12.
 * @update 2014. 5. 29.
 * @version 2.2
 *
 * 2.2 개선사항
 * 1. 데이터 ajax 로딩 추가
 * 2. multi, single 형태 추가
 */
var $S = {
    /*
     * current module name
     */
    sModule : 'xans-product-listmain',

    /*
     * swipe action name
     */
    sModuleSwipe : '',

    /*
     * mode
     */
    sMode : 'multi',

    /*
     * slider
     */
    bSlider : false,

    /*
     * swipeable
     */
    sSwipeable : 'yes',

    /*
     * sParam
     */
    sParam : '',

    /*
     * grid
     */
    sGrid : 'grid3',

    /*
     * grid array
     */
    aGrid : {'grid2':2, 'grid3':3, 'grid4':4, 'grid5':5},

    /*
     * start slide
     */
    iStart : 0,

    /*
     * page
     */
    iPage : 1,

    /*
     * page block
     */
    iPageBlock : 3,

    /*
     * line
     */
    iLine : 1,

    /*
     * limit circle
     */
    iLimit : 9,

    /*
     * active div
     */
    iActive : 0,

    /*
     * save li element
     */
    aElement : [],

    /*
     * save circle element
     */
    aButton : [],

    /*
     * product class
     */
    $product : null,

    /*
     * product ul
     */
    $productModule : null,

    /*
     * product list li
     */
    $productList : null,

    /*
     * ajax loading
     */
    bAjax : true,

    /*
     * generate dom
     */
    bGenerate : false,

    /*
     * ajax count
     */
    iAjax : 0,

    /*
     * auto slide interval
     */
    iAutoSlideInterval : 0,

    /*
     *  paging ui
     */
    sPagingType : 'circle',

    iProductTotal : 0,

    /*
     * cache 사용여부
     */
    sCache : 'no',

    /*
     * init
     */
    init : function() {
        // set param
        this.setParam();

         // set obejct
        this.setObject();

        // set block
        this.setBlock();

        // validate
        if (this.validate() === false) return;

         // generate
        this.generate();

        // load swipe
        this.load();
    },

    /*
     * set param
     */
    setParam : function() {
        try
        {
            this.sModuleSwipe = this.sModule.replace(/-/g, "_");
            this.iAjax = oMobileSliderData.iSliderLimit;
        }
        catch (e) { }
    },

    /*
     * set block
     */
    setBlock : function() {
        // set block num
        this.iPageBlock = (this.sMode == 'multi') ? this.iLine * this.aGrid[this.sGrid] : 1;
    },

    /*
     * set obejct
     */
    setObject : function() {
        try
        {
            // current module class
            this.sActiveProduct = this.iActive > 0 ? this.sModule + '-'+this.iActive : this.sModule;

            // div
            this.$product = $('.' + this.sActiveProduct);

            // div > ul
            this.$productModule = this.$product.find('ul:first');
            this.$productModule.css('webkit-backface-visibility', 'hidden');

            // div > ul > li > ul > li
            this.$productList = this.$productModule.find('>li');
        }
        catch (e) { }
    },

    /*
     * validate
     */
    validate : function() {
        // not use swipe
        if (this.sSwipeable != 'yes') return false;

        // empty ul
        if (this.$productModule.size() < 1) return false;

        // empty li
        if (this.$productList.size() < 1) return false;

        // mobilemaincategory-slider exception
        if (this.$productModule.find('.afterNone').size() > 0) return true;

        // no condition swipe
        if (this.$productList.size() <= this.iPageBlock) return false;
    },

    /*
     * ganerate swipe single dom
     */
    generate : function() {
        if (this.sMode == 'single') { this.generateSingle(); }
        else { this.generateMulti(); }
    },

    /*
     * prepare for element
     */
    prepare : function() {
        var $prepare = {
            /*
             * reset element and circle
             */
            reset : function() {
                $S.aElement = [];
                $S.aButton = [];
            },

            /*
             * set target id
             */
            setId : function() {
                $S.$product.attr('id', $S.sModule + '-slider-' + $S.iActive);
            }
        }
        $prepare.reset();
        $prepare.setId();
    },

    /*
     * ganerate swipe single dom
     */
    generateSingle : function() {
        // prepare
        this.prepare();

        // make li > ul > li
        for (var i=0; i<this.$productList.size(); i++) {
            this.makeButton(i);
        }

        // call pagenate
        this.makePagenate();
    },


    /*
     * reset grid
     */
    resetGrid : function() {
        for (var sKey in this.aGrid) {
            if (this.$productModule.hasClass(sKey) === true) { this.$productModule.empty().removeClass(sKey); }
        }
    },

    /*
     * ganerate swipe multi dom
     */
    generateMulti : function() {
        // prepare
        this.prepare();

        if (this.bGenerate === false) return;

        // save li
        this.$productList.each(function(){ $S.aElement.push($(this).clone(true)); });

        // delete li and grid2, gird3, grid4
        this.resetGrid();

        this.iProductTotal = this.aElement.length;
        this.iTotalPage = Math.ceil(this.iProductTotal / this.iPageBlock);

        // make li > ul > li
        for (var i=0, k=1, j=0; i<this.iProductTotal; i++, k++)
        {
            // templete for li > ul
            var $template = (j == 0) ? $("<li>", { html: $("<ul>", {'class': this.sGrid} ) } ) : $('<li>', { html: $("<ul>", {'class': this.sGrid} ), css: {'display': 'none'} } );

            // add li > ul
            if (k == 1)
            {
                this.$productModule.append($template);
                // <  현재페이지 / 총페이지 >
                if (this.sPagingType !== 'number') {
                    this.makeButton(j);
                }
            }

            // add li > ul > li
            this.$product.children('ul').children('li').eq(j).children('ul').append(this.aElement[i]);

            // see block
            if (k == this.iPageBlock)
            {
                k = 0;
                j++;
            }
        }

        if (this.sPagingType === 'number') {
            this.makeNumber();
        }
        // not necessary pagenate
        if (i < (parseInt(this.iPageBlock) + 1)) return;

        // call pagenate
        this.makePagenate();
    },

    makeButton : function(iCnt) {
        // ECQAINT-14112 롤링 및 넘버링 타입은 '모바일 환경설정'의 기본 사양에 따라 최대 갯수 5개로 설정
        if (this.sPagingType == 'rolling' || this.sPagingType == 'numbering') {
            this.iLimit = 5;
        } else if (this.sPagingType !== 'circle') {
            this.iLimit = 4;
        }

        var iNum = iCnt + 1,
        sSelected = (iCnt == 0) ? 'selected' : '',
        iPage = Math.ceil(iNum / this.iLimit),
        sLimitStyle = (iNum > this.iLimit) ? 'style="display:none"' : '',
        sName = this.sActiveProduct + '_page_'+iPage+'_'+iNum;

        if (this.sPagingType === 'fix') {
            var sSelected = (iCnt == 0) ? 'this' : 'other';
            this.divPaginateName = 'typeList';
            this.aButton.push( '<li name="'+sName+'" ' + sLimitStyle +'><a class="' + sSelected + '" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.moveTab(' + iCnt + ', ' + this.iAutoSlideInterval  +');return false;">' + iNum +'</a></li>' );
        } else if (this.sPagingType === 'numbering') {
            this.divPaginateName = 'typeNumber';
        } else if (this.sPagingType === 'rolling') {
            this.divPaginateName = 'typeRoll';
            this.aButton.push('<li class="' + sSelected + '" name="' + sName + '"><a href="#none" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.moveTab(' + iCnt + ', ' + this.iAutoSlideInterval  +');return false;">' + iNum + '</a></li>');
        } else {
            // circle
            this.divPaginateName = 'typeSwipe';
            this.aButton.push( '<button name="'+sName+'" type="button" ' + sLimitStyle +' class="circle  ' + sSelected + '" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.moveTab(' + iCnt + ', ' + this.iAutoSlideInterval  +');return false;"><span>' + iNum +'번째 리스트</span></button>' );
        }
    },

    /*
     * make fix number
     */
    makeNumber : function() {
        this.divPaginateName = 'typeTotal';
        sName = this.sModule+'-'+this.iActive+'_page';
        this.aButton.push('<span name="' + sName + '" class="page"><strong>1</strong> / <span>' + this.iTotalPage + '</span></span>');
    },

    /*
     * make pagenation
     */
    makePagenate : function() {
        var sSwipeId = this.sModule + '-swipe-button-' + this.iActive;
        var sPaginateStyle = '';
        var aBtn = [];
        if (this.sPagingType === 'fix') {
            aBtn.push('<p class="prev" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.prev();return false;"><a href="#none"><span>이전 페이지</span></a></p>');
            aBtn.push('<ol id='+ sSwipeId +'>'+this.aButton.join('')+'</ol>');
            aBtn.push('<p class="next" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.next();return false;"><a href="#none"><span>다음 페이지</span></a></p>');
        } else if (this.sPagingType === 'numbering') {
            aBtn.push('<p><strong>1</strong> / <span>' + this.$productList.size() + '</span></p>');
        } else if (this.sPagingType === 'rolling') {
            sPaginateStyle = 'position:static;';
            aBtn.push('<ol id='+ sSwipeId +' class="grid' + this.$productList.size() + '">'+this.aButton.join('')+'</ol>');
        } else if (this.sPagingType === 'number') {
            aBtn.push('<p class="prev" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.prev();return false;"><a href="#none"><span>이전 페이지</span></a></p>');
            aBtn.push(this.aButton.join(''));
            aBtn.push('<p class="next" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.next();return false;"><a href="#none"><span>다음 페이지</span></a></p>');
        } else {
            aBtn.push( '<button type="button" class="prev" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.prev();return false;"><span>이전 리스트</span></button>' );
            aBtn.push( '<span id="' + sSwipeId + '">' +  this.aButton.join('') +'</span>' );
            aBtn.push( '<button type="button" class="next" onclick="$' + this.sModuleSwipe + '_slider_' + this.iActive + '.next();return false;"><span>다음 리스트</span></button>' );
        }

        var sPaginateForm = '<div class="paginate '+this.divPaginateName+'" style="' + sPaginateStyle + '">' + aBtn.join('') + '</div>';

        if ($S.bSlider === false) { this.$product.append(sPaginateForm); }
    },

    /*
     * call ajax
     */
    callAjax : function() {
        this.iPage++;
        this.setAjaxParam();

        var $ajaxLoadContainer = {
            load : function() {
                var $load = '<div class="loading"><img src="//img.echosting.cafe24.com/design/skin/mobile/img_loading.gif" alt="" /></div>',
                    $dimmed = '<div class="dimmed"></div>';
                $('body').append($load + $dimmed);
            },
            remove : function() {
                $('body').find('div.loading, div.dimmed').remove();
            }
        };

        $.ajax({
            type : "get",
            url : this.sParam,
            dataType : "json",
            success : function(data){
                try{
                    if (data.rtn_code == '1000') {
                        $(data.rtn_data.data).each(function(index, node) {
                            // new index
                            var newElementIndex = $S.iAjax + index;
                            // append new element
                            $S.$productModule.append(EC_MOBILE_UTIL.convertNode(node));
                            // set onerror img
                            EC_MOBILE_UTIL.setDefaultImage();
                            // element setting
                            $S.$product.find('li').eq(newElementIndex).css({
                                width : $(window).width() + 'px',
                                display : 'table-cell',
                                'vertical-align' : 'top'
                            }).bind('click', function(){ globalPictorlControl($S.$product); });
                        });

                        var len = data.rtn_data.data.length, currentSlider = '$' + $S.sModuleSwipe + '_slider_' + $S.iActive;

                        // set swipe scale
                        $S.$productModule.width($S.$productModule.width() + ($(window).width() * len));
                        // add ajax condition
                        $S.iAjax += len;
                        // stop ajax control
                        if (len < oMobileSliderData.iSliderLimit) { $S.bAjax = false; }
                    } else {
                        alert('상품을 추가로 더 불러오는 과정에 문제가 발생했습니다. 지속적으로 발생할 경우 운영자에게 문의하세요.');
                        return false;
                    }
                } catch(e) {
                    $ajaxLoadContainer.remove();
                }
            },
            error: function(xhr,status,error){
                //alert('네크워크나 상품API연동에 문제가 있습니다. 지속적으로 발생할 경우 운영자에게 문의하세요.');
                return false;
            },
            beforeSend:function(){
                $ajaxLoadContainer.load();
            },
            complete:function() {
                $ajaxLoadContainer.remove();
                // set swipe module length && excute next slider
                var currentSlider = '$' + $S.sModuleSwipe + '_slider_' + $S.iActive;
                eval(currentSlider + '.setLength(' + $S.iAjax + ');');
            }
        });
    },

    /*
     * set Param
     */
    setAjaxParam : function() {
        var aParam = [];

        aParam['cate_no']          = oMobileSliderData.iCategoryNo;
        aParam['page']             = this.iPage;
        aParam['count']            = oMobileSliderData.iSliderLimit;

        this.sParam = EC_MOBILE_UTIL.setAjaxParam(aParam, this.sModule);
    },

    /*
     * load swipe js
     */
    load : function() {
        try
        {
            var aSwipeVars = [],
                $swipe = document.getElementById('' + this.sModule + '-slider-' + this.iActive + ''),
                $now = this.$product.find('div.swipePage').find('span.now');

            if (this.sPagingType !== 'circle') {
                this.$product.find('.typeSwipe .prev, .typeSwipe .next').show();
            }

            // 상품의 고유한 값(상품 번호 및 카테고리 번호 등)을 지정
            // 이렇게 하지 않으면 스와이프 모듈을 하나로 인식하여 처리되기 때문
            var sProductInfo = '';

            // try-catch로 모듈의 상품 정보를 불러와서 처리하고, 정보가 없으면 처리하지 않음
            try {
                sProductInfo = this.$productModule.find('li:first').attr('data-param').replace(/\?/gi, '').replace(/\&\=/gi, '_');
            } catch(e) {
            }

            aSwipeVars.push( '$' + this.sModuleSwipe + '_slider_' + this.iActive + ' = new SwipeClient($swipe, {' );
            aSwipeVars.push( '    startSlide: ' + this.iStart + ',' );
            aSwipeVars.push( '    auto: ' + this.iAutoSlideInterval + ',' );
            aSwipeVars.push( '    cache: \'' + this.sCache + '\',' );
            aSwipeVars.push( '    elementId: \'' + this.sModuleSwipe + '_slider_' + sProductInfo + '\',' );
            aSwipeVars.push( '    callback: function(e, pos, ele, obj) {' );
            aSwipeVars.push( '        if (obj.container.id == "xans-layout-mobilemaincategory-slider-0") { globalCategorySetUi(mode = "init", pos); }' );
            aSwipeVars.push( '        try { if (globalPictorialLoad === true) { globalPictorialSetUi($S.$product, pos) } } catch(e) {}' );
            aSwipeVars.push( '        var iSelectedPos = pos + 1;' );
            aSwipeVars.push( '        if ($S.bSlider === true) { $now.text(iSelectedPos); }' );
            aSwipeVars.push(this.getSwipeButtonDisplay());
            aSwipeVars.push( '    }' );
            aSwipeVars.push( '});' );

            eval(aSwipeVars.join(''));
        }
        catch(e) { }
    },

    getSwipeButtonDisplay : function() {
        var sSelected = 'selected';
        var sChildSelector = '';
        if (this.sPagingType === 'fix') {
            sSelected = 'this';
            sChildSelector = ' > a';
        }

        var sSwipeVars = '';
        if (this.sPagingType === 'number') {
            sSwipeVars = '        $("[name^=\'' + this.sActiveProduct + '_page\'] > strong").text(iSelectedPos);' ;
        } else if (this.sPagingType === 'numbering') {
            sSwipeVars = '$(".' + this.divPaginateName + ' > p > strong").text(iSelectedPos);';
        } else if (this.sPagingType === 'rolling') {
            sSwipeVars = '         $("[name^=\'' + this.sActiveProduct + '_page\']").removeClass(\'' + sSelected + '\');';
            sSwipeVars += '        $("[name=\'' + this.sActiveProduct + '_page_1_"+iSelectedPos+"\']").addClass(\'' + sSelected + '\');';
        } else {
            sSwipeVars = '         var iPage = pos === ' + this.iTotalPage + ' ? Math.ceil(' + this.iTotalPage + ' / $S.iLimit) : Math.ceil(iSelectedPos / $S.iLimit);' ;

            /*
                ECHOSTING-251668 show/hide 조건 삭제

                sSwipeVars += '        if ((pos % $S.iLimit === 0) || (iSelectedPos % $S.iLimit === 0 || iSelectedPos === ' + this.iTotalPage + ')) {';
                sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page\']").hide();';
                sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page_"+iPage+"\']").show();';
                sSwipeVars += '        }';
                sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page\']' + sChildSelector + '").removeClass(\'' + sSelected + '\');';
                sSwipeVars += '        $("[name=\'' + this.sActiveProduct + '_page_"+iPage+"_"+iSelectedPos+"\']' + sChildSelector + '").addClass(\'' + sSelected + '\');';
            */

            sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page\']").hide();';
            sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page_"+iPage+"\']").show();';
            sSwipeVars += '        $("[name^=\'' + this.sActiveProduct + '_page\']' + sChildSelector + '").removeClass(\'' + sSelected + '\');';
            sSwipeVars += '        $("[name=\'' + this.sActiveProduct + '_page_"+iPage+"_"+iSelectedPos+"\']' + sChildSelector + '").addClass(\'' + sSelected + '\');';
        }
        return sSwipeVars;
    }

};
/**
 * 비동기식 데이터
 */
var CAPP_ASYNC_METHODS = {
    DEBUG: false,
    IS_LOGIN: (document.cookie.match(/(?:^| |;)iscache=F/) ? true : false),
    EC_PATH_ROLE: $('meta[name="path_role"]').attr('content') || '',
    aDatasetList: [],
    $xansMyshopMain: $('.xans-myshop-main'),
    init : function()
    {
    	var bDebug = CAPP_ASYNC_METHODS.DEBUG;

        var aUseModules = [];
        var aNoCachedModules = [];

        $(CAPP_ASYNC_METHODS.aDatasetList).each(function(){
            var sKey = this;

            var oTarget = CAPP_ASYNC_METHODS[sKey];

            if (bDebug) {
                console.log(sKey);
            }
            var bIsUse = oTarget.isUse();
            if (bDebug) {
                console.log('   isUse() : ' + bIsUse);
            }

            if (bIsUse === true) {
                aUseModules.push(sKey);

                if (oTarget.restoreCache === undefined || oTarget.restoreCache() === false) {
                    if (bDebug) {
                        console.log('   restoreCache() : true');
                    }
                    aNoCachedModules.push(sKey);
                }
            }
        });

        if (aNoCachedModules.length > 0) {
            var sEditor = '';
            try {
                if (bEditor === true) {
                    // 에디터에서 접근했을 경우 임의의 상품 지정
                    sEditor = '&PREVIEW_SDE=1';
                }
            } catch(e) { }

            var sPathRole = '&path_role=' + CAPP_ASYNC_METHODS.EC_PATH_ROLE;

            $.ajax(
            {
                url : '/exec/front/manage/async?module=' + aNoCachedModules.join(',') + sEditor + sPathRole,
                dataType : 'json',
                success : function(aData)
                {
                	CAPP_ASYNC_METHODS.setData(aData, aUseModules);
                }
            });

        } else {
        	CAPP_ASYNC_METHODS.setData({}, aUseModules);

        }
    },
    setData : function(aData, aUseModules)
    {
        aData = aData || {};

        $(aUseModules).each(function(){
            var sKey = this;

            var oTarget = CAPP_ASYNC_METHODS[sKey];

            if (oTarget.setData !== undefined && aData.hasOwnProperty(sKey) === true) {
                oTarget.setData(aData[sKey]);
            }

            if (oTarget.execute !== undefined) {
                oTarget.execute();
            }
        });
    }
};
/**
 * 비동기식 데이터 - 최근 본 상품 - 보여줄 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('recentViewConfig');
CAPP_ASYNC_METHODS.recentViewConfig = {
    STORAGE_KEY: 'localRecentViewConfig' +  EC_SDE_SHOP_NUM,

    __iViewCount: null,
    __sAdult19Warning: 'F',
    __sAdult19BaseImage: null,

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.recent.isUse() === false) {
            return false;
        }

        if (window.sessionStorage === undefined) {
            return false;
        }

        return true;
    },

    restoreCache: function()
    {
        if (window.sessionStorage === undefined) {
            return false;
        }

        var sSessionStorageDataWrapedJson = window.sessionStorage.getItem(this.STORAGE_KEY);
        if (sSessionStorageDataWrapedJson === null) {
            return false;
        }
        this.__setConfigs(sSessionStorageDataWrapedJson);
        return true;
    },

    setData: function(sData)
    {
        var aData = new Array();
        aData.push('"adult19BaseTinyImage":"' + sData.adult19BaseTinyImage + '"');
        aData.push('"adult19Warning":"' + sData.adult19Warning + '"');
        aData.push('"viewCount":"' + sData.viewCount + '"');

        var sDataWrapedJson = '{' + aData.join(",") + '}'; //JSON.stringify(sData); IE7 NOT COMPATIBLE

        try {
            window.sessionStorage.setItem(this.STORAGE_KEY, sDataWrapedJson);
        } catch (error) {
        }
        this.__setConfigs(sDataWrapedJson);
    },

    getViewCount: function()
    {
        return this.__iViewCount;
    },

    getAdult19Warning: function()
    {
        return this.__sAdult19Warning;
    },

    getAdult19BaseImage: function()
    {
        return this.__sAdult19BaseImage;
    },


    __setConfigs: function(sDataJson)
    {
        var aRecentViewConfig = $.parseJSON(sDataJson);

        var sAdult19Warning = aRecentViewConfig['adult19Warning'];
        if (sAdult19Warning !== 'T') {
            sAdult19Warning = 'F'
        };
        this.__sAdult19Warning = sAdult19Warning;

        this.__sAdult19BaseImage = aRecentViewConfig['adult19BaseTinyImage'];
        this.__iViewCount = Number(aRecentViewConfig['viewCount']);

    }

};
/**
 * 비동기식 데이터 - 회원 정보
 */
CAPP_ASYNC_METHODS.aDatasetList.push('member');
CAPP_ASYNC_METHODS.member = {
    __sEncryptedString: null,
    __isAdult: 'F',

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if ($('.xans-layout-statelogon, .xans-layout-logon').length > 0) {
                return true;
            }

            if (CAPP_ASYNC_METHODS.recentViewConfig.getAdult19Warning() === 'T' && CAPP_ASYNC_METHODS.recent.isUse() === true) {
                return true;
            }
        }
        return false;
    },

    setData: function(oData)
    {
        this.__sEncryptedString = oData.memberData;
        this.__isAdult = oData.memberIsAdult;
    },

    execute: function()
    {
        AuthSSLManager.weave({
            'auth_mode'          : 'decryptClient',
            'auth_string'        : this.__sEncryptedString,
            'auth_callbackName'  : 'CAPP_ASYNC_METHODS.member.setDataCallback'
       });
    },

    setDataCallback: function(output)
    {
        try {
            var output = decodeURIComponent(output);

            if ( AuthSSLManager.isError(output) == true ) {
                alert(output);
                return;
            }

            var aData = AuthSSLManager.unserialize(output);
            
            // 친구초대
            if ($('.xans-myshop-asyncbenefit').size() > 0) {
                $('#reco_url').attr({value: $('#reco_url').val() + aData['id']});
            }

            for (var k in aData) {
                $('.xans-member-var-' + k).html(aData[k]);
            }
        } catch(e) {}
    },

    getMemberIsAdult: function()
    {
        return this.__isAdult;
    }
};

/**
 * 비동기식 데이터 - 예치금
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Ordercnt');
CAPP_ASYNC_METHODS.Ordercnt = {
    __iOrderShppiedBeforeCount: null,
    __iOrderShppiedStandbyCount: null,
    __iOrderShppiedBeginCount: null,
    __iOrderShppiedComplateCount: null,
    __iOrderShppiedCancelCount: null,
    __iOrderShppiedExchangeCount: null,
    __iOrderShppiedReturnCount: null,

    __$target: $('#xans_myshop_orderstate_shppied_before_count'),
    __$target2: $('#xans_myshop_orderstate_shppied_standby_count'),
    __$target3: $('#xans_myshop_orderstate_shppied_begin_count'),
    __$target4: $('#xans_myshop_orderstate_shppied_complate_count'),
    __$target5: $('#xans_myshop_orderstate_order_cancel_count'),
    __$target6: $('#xans_myshop_orderstate_order_exchange_count'),
    __$target7: $('#xans_myshop_orderstate_order_return_count'),

    isUse: function()
    {
        if ($('.xans-myshop-orderstate').length > 0) {
            return true; 
        }

        return false;
    },

    setData: function(aData)
    {
        this.__iOrderShppiedBeforeCount = aData['shipped_before_count'];
        this.__iOrderShppiedStandbyCount = aData['shipped_standby_count'];
        this.__iOrderShppiedBeginCount = aData['shipped_begin_count'];
        this.__iOrderShppiedComplateCount = aData['shipped_complate_count'];
        this.__iOrderShppiedCancelCount = aData['order_cancel_count'];
        this.__iOrderShppiedExchangeCount = aData['order_exchange_count'];
        this.__iOrderShppiedReturnCount = aData['order_return_count'];
    },

    execute: function()
    {
        this.__$target.html(this.__iOrderShppiedBeforeCount);
        this.__$target2.html(this.__iOrderShppiedStandbyCount);
        this.__$target3.html(this.__iOrderShppiedBeginCount);
        this.__$target4.html(this.__iOrderShppiedComplateCount);
        this.__$target5.html(this.__iOrderShppiedCancelCount);
        this.__$target6.html(this.__iOrderShppiedExchangeCount);
        this.__$target7.html(this.__iOrderShppiedReturnCount);
    }
};
/**
 * 비동기식 데이터 - 장바구니 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Basketcnt');
CAPP_ASYNC_METHODS.Basketcnt = {
    __iBasketCount: null,

    __$target: $('.xans-layout-orderbasketcount span a'),
    __$target2: $('#xans_myshop_basket_cnt'),
    __$target3: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_basket_cnt'),
    __$target4: $('.EC-Layout-Basket-count'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        if (this.__$target2.length > 0) {
            return true;
        }
        if (this.__$target3.length > 0) {
            return true;
        }
        
        if (this.__$target4.length > 0) {
            return true;
        }

        return false;
    },
    restoreCache: function()
    {
        var sCookieName = 'basketcount_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iBasketCount = parseInt(aCookieValue[1], 10);
            return true;
        }
        
        return false;
    },
    setData: function(sData)
    {
        this.__iBasketCount = Number(sData);
    },
    execute: function()
    {
        this.__$target.html(this.__iBasketCount);

        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target2.html(this.__iBasketCount + '개');
        } else {
            this.__$target2.html(this.__iBasketCount);
        }

        this.__$target3.html(this.__iBasketCount);
        
        this.__$target4.html(this.__iBasketCount);
        
        if (this.__iBasketCount > 0 && this.__$target4.length > 0) {
        	var $oCountDisplay = $('.EC-Layout_Basket-count-display');
        	
        	if ($oCountDisplay.length > 0) {
        		$oCountDisplay.removeClass('displaynone');
        	}
        	
        }
    }
};
/**
 * 비동기식 데이터 - 장바구니 금액
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Basketprice');
CAPP_ASYNC_METHODS.Basketprice = {
    __sBasketPrice: null,

    __$target: $('#xans_myshop_basket_price'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }

        return false;
    },
    restoreCache: function()
    {
        var sCookieName = 'basketprice_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__sBasketPrice = decodeURIComponent((aCookieValue[1]+ '').replace(/\+/g, '%20'));
            return true;
        }
        
        return false;
    },
    setData: function(sData)
    {
        this.__sBasketPrice = sData;
    },

    execute: function()
    {
        this.__$target.html(this.__sBasketPrice);
    }
};
/**
 * 비동기식 데이터 - 쿠폰 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Couponcnt');
CAPP_ASYNC_METHODS.Couponcnt = {
    __iCouponCount: null,

    __$target: $('.xans-layout-myshopcouponcount'),
    __$target2: $('#xans_myshop_coupon_cnt'),
    __$target3: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_coupon_cnt'),
    __$target4: $('#xans_myshop_bankbook_coupon_cnt'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
            
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }
            
            if (this.__$target4.length > 0) {
                return true;
            }            
        }

        return false;
    },
    
    restoreCache: function()
    {
        var sCookieName = 'couponcount_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iCouponCount = parseInt(aCookieValue[1], 10);
            return true;
        }
        
        return false;
    },
    setData: function(sData)
    {
        this.__iCouponCount = Number(sData);
    },

    execute: function()
    {
        this.__$target.html(this.__iCouponCount);

        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target2.html(this.__iCouponCount + '개');
        } else {
            this.__$target2.html(this.__iCouponCount);
        }

        this.__$target3.html(this.__iCouponCount);
        this.__$target4.html(this.__iCouponCount);
    }
};
/**
 * 비동기식 데이터 - 적립금
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Mileage');
CAPP_ASYNC_METHODS.Mileage = {
    __sMileage: null,
    __sUsedMileage: null,
    __sTotalMileage: null,
    __sUnavailMileage: null,
    __sReturnedMileage: null,

    __$target: $('#xans_myshop_mileage'),
    __$target2: $('#xans_myshop_bankbook_avail_mileage, #xans_myshop_summary_avail_mileage'),
    __$target3: $('#xans_myshop_bankbook_used_mileage, #xans_myshop_summary_used_mileage'),
    __$target4: $('#xans_myshop_bankbook_total_mileage, #xans_myshop_summary_total_mileage'),
    __$target5: $('#xans_myshop_summary_unavail_mileage'),
    __$target6: $('#xans_myshop_summary_returned_mileage'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
      
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }       
            
            if (this.__$target4.length > 0) {
                return true;
            }     
            
            if (this.__$target5.length > 0) {
                return true;
            }  
            
            if (this.__$target6.length > 0) {
                return true;
            }              
        }

        return false;
    },

    setData: function(aData)
    {
        this.__sMileage = aData['avail_mileage'];
        this.__sUsedMileage = aData['used_mileage'];
        this.__sTotalMileage = aData['total_mileage'];
        this.__sUnavailMileage = aData['unavail_mileage'];
        this.__sReturnedMileage = aData['returned_mileage'];
    },

    execute: function()
    {
        this.__$target.html(this.__sMileage);
        this.__$target2.html(this.__sMileage);
        this.__$target3.html(this.__sUsedMileage);
        this.__$target4.html(this.__sTotalMileage);
        this.__$target5.html(this.__sUnavailMileage);
        this.__$target6.html(this.__sReturnedMileage);
    }
};
/**
 * 비동기식 데이터 - 예치금
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Deposit');
CAPP_ASYNC_METHODS.Deposit = {
    __sDeposit: null,
    __sAllDeposit: null,
    __sUsedDeposit: null,
    __sRefundWaitDeposit: null,

    __$target: $('#xans_myshop_deposit'),
    __$target2: $('#xans_myshop_bankbook_deposit'),
    __$target3: $('#xans_myshop_summary_deposit'),
    __$target4: $('#xans_myshop_summary_all_deposit'),
    __$target5: $('#xans_myshop_summary_used_deposit'),
    __$target6: $('#xans_myshop_summary_refund_wait_deposit'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
            
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }  
            
            if (this.__$target4.length > 0) {
                return true;
            }  
            
            if (this.__$target5.length > 0) {
                return true;
            }  
            
            if (this.__$target6.length > 0) {
                return true;
            }  
        }

        return false;
    },

    setData: function(aData)
    {
        this.__sDeposit = aData['total_deposit'];
        this.__sAllDeposit = aData['all_deposit'];
        this.__sUsedDeposit = aData['used_deposit'];
        this.__sRefundWaitDeposit = aData['deposit_refund_wait'];
        this.__sDepositUnit = aData['deposit_unit'];
    },

    execute: function()
    {
        this.__$target.html(this.__sDeposit);
        this.__$target2.html(this.__sDeposit);
        this.__$target3.html(this.__sDeposit);
        this.__$target4.html(this.__sAllDeposit);
        this.__$target5.html(this.__sUsedDeposit);
        this.__$target6.html(this.__sRefundWaitDeposit);        
    }
};
/**
 * 비동기식 데이터 - 관심상품 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Wishcount');
CAPP_ASYNC_METHODS.Wishcount = {
    __iWishCount: null,

    __$target: $('#xans_myshop_interest_prd_cnt'),
    __$target2: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_interest_prd_cnt'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        if (this.__$target2.length > 0) {
            return true;
        }
        return false;
    },

    restoreCache: function()
    {
        var sCookieName = 'wishcount_' + EC_SDE_SHOP_NUM;
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iWishCount = parseInt(aCookieValue[1], 10);
            return true;
        }

        return false;
    },

    setData: function(sData)
    {
        this.__iWishCount = Number(sData);
    },

    execute: function()
    {
        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target.html(this.__iWishCount + '개');
        } else {
            this.__$target.html(this.__iWishCount);
        }

        this.__$target2.html(this.__iWishCount);
    }
};
/**
 * 비동기식 데이터 - 최근 본 상품
 */
CAPP_ASYNC_METHODS.aDatasetList.push('recent');
CAPP_ASYNC_METHODS.recent = {
    STORAGE_KEY: 'localRecentProduct' +  EC_SDE_SHOP_NUM,

    __$target: $('.xans-layout-productrecent'),

    __aData: null,

    isUse: function()
    {
        this.__$target.hide();

        if (this.__$target.find('.xans-record-').length > 0) {
            return true;
        }

        return false;
    },

    restoreCache: function()
    {
        this.__aData = [];

        var iTotalCount = CAPP_ASYNC_METHODS.RecentTotalCount.getData();
        if (iTotalCount == 0) {
            // 총 갯수가 없는 경우 복구할 것이 없으므로 복구한 것으로 리턴
            return true;
        }

        var sAdultImage = '';

        if (window.sessionStorage === undefined) {
            return false;
        }

        var sSessionStorageData = window.sessionStorage.getItem(this.STORAGE_KEY);
        if (sSessionStorageData === null) {
            return false;
        }

        var iViewCount = CAPP_ASYNC_METHODS.recentViewConfig.getViewCount();

        this.__aData = [];
        var aStorageData = $.parseJSON(sSessionStorageData);
        var iCount = 1;
        var bDispRecent = true;
        for (var iKey in aStorageData) {
            var sProductImgSrc = aStorageData[iKey].sImgSrc;

            if (isFinite(iKey) === false) {
                continue;
            }

            var aDataTmp = [];
            aDataTmp.recent_img = getImageUrl(sProductImgSrc);
            aDataTmp.name = aStorageData[iKey].sProductName;
            aDataTmp.disp_recent = true;
            aDataTmp.is_adult_product = aStorageData[iKey].isAdultProduct;
            aDataTmp.link_product_detail = aStorageData[iKey].link_product_detail;

            //aDataTmp.param = '?product_no=' + aStorageData[iKey].iProductNo + '&cate_no=' + aStorageData[iKey].iCateNum + '&display_group=' + aStorageData[iKey].iDisplayGroup;
            aDataTmp.param = filterXssUrlParameter(aStorageData[iKey].sParam);
            if ( iViewCount < iCount ) {
                bDispRecent = false;
            }
            aDataTmp.disp_recent = bDispRecent;

            iCount++;
            this.__aData.push(aDataTmp);
        }

        return true;

        /**
         * get SessionStorage image url
         * @param sNewImgUrl DB에 저장되어 있는 tiny값
         */
        function getImageUrl(sImgUrl)
        {
            if ( typeof(sImgUrl) === 'undefined' || sImgUrl === null) {
                return;
            }
            var sNewImgUrl = '';

            if ( sImgUrl.indexOf('http://') >= 0 || sImgUrl.indexOf('https://')  >= 0 || sImgUrl.substr(0, 2) === '//') {
                sNewImgUrl = sImgUrl;
            } else {
                sNewImgUrl = '/web/product/tiny/' +  sImgUrl;
            }

            return sNewImgUrl;
        }

        /**
         * 파라미터 URL에서 XSS 공격 관련 파라미터를 필터링합니다. ECHOSTING-162977
         * @param string sParam 파라미터
         * @return string 필터링된 파라미터
         */
        function filterXssUrlParameter(sParam)
        {
            sParam = sParam || '';

            var sPrefix = '';
            if (sParam.substr(0, 1) === '?') {
                sPrefix = '?';
                sParam = sParam.substr(1);
            }

            var aParam = {};

            var aParamList = (sParam).split('&');
            $.each(aParamList, function() {
                var aMatch = this.match(/^([^=]+)=(.*)$/);
                if (aMatch) {
                    aParam[aMatch[1]] = aMatch[2];
                }
            });

            return sPrefix + $.param(aParam);
        }

    },

    setData: function(aData)
    {
        this.__aData = aData;

        // 쿠키엔 있지만 sessionStorage에 없는 데이터 복구
        if (window.sessionStorage) {

            var oNewStorageData = [];

            for ( var i = 0 ; i < aData.length ; i++) {
                if (aData[i].bNewProduct !== true) {
                    continue;
                }

                var aNewStorageData = {
                    'iProductNo': aData[i].product_no,
                    'sProductName': aData[i].name,
                    'sImgSrc': aData[i].recent_img,
                    'sParam': aData[i].param,
                    'link_product_detail': aData[i].link_product_detail
                };

                oNewStorageData.push(aNewStorageData);
            }

            if ( oNewStorageData.length > 0 ) {
                sessionStorage.setItem(this.STORAGE_KEY , $.toJSON(oNewStorageData));
            }
        }
    },

    execute: function()
    {
        var sAdult19Warning = CAPP_ASYNC_METHODS.recentViewConfig.getAdult19Warning();

        var aData = this.__aData;

        var aNodes = this.__$target.find('.xans-record-');
        var iRecordCnt = aNodes.length;
        var iAddedElementCount = 0;

        var aNodesParent = $(aNodes[0]).parent();
        for ( var i = 0 ; i < aData.length ; i++) {
            if (!aNodes[i]) {
                $(aNodes[iRecordCnt - 1]).clone().appendTo(aNodesParent);
                iAddedElementCount++;
            }
        }

        if (iAddedElementCount > 0) {
            aNodes = this.__$target.find('.xans-record-');
        }

        if (aData.length > 0) {
            this.__$target.show();
        }

        for ( var i = 0 ; i < aData.length ; i++) {
            assignVariables(aNodes[i], aData[i]);
        }

        // 종료 카운트 지정
        if (aData.length < aNodes.length) {
            iLength = aData.length;
            deleteNode();
        }

        recentBntInit(this.__$target);

        /**
         * 패치되지 않은 노드를 제거
         */
        function deleteNode()
        {
            for ( var i = iLength ; i < aNodes.length ; i++) {
                $(aNodes[i]).remove();
            }
        }

        /**
         * oTarget 엘레먼트에 aData의 변수를 어싸인합니다.
         * @param Element oTarget 변수를 어싸인할 엘레먼트
         * @param array aData 변수 데이터
         */
        function assignVariables(oTarget, aData)
        {
            var recentImage = aData.recent_img;

            if (sAdult19Warning === 'T' && CAPP_ASYNC_METHODS.member.getMemberIsAdult() === 'F' && aData.is_adult_product === 'T') {
                    recentImage = CAPP_ASYNC_METHODS.recentViewConfig.getAdult19BaseImage();
            };

            var $oTarget = $(oTarget);

            var sHtml = $oTarget.html();

            sHtml = sHtml.replace('about:blank', recentImage)
                         .replace('##param##', aData.param)
                         .replace('##name##',aData.name)
                         .replace('##link_product_detail##', aData.link_product_detail);
            $oTarget.html(sHtml);

            if (aData.disp_recent === true) {
                $oTarget.removeClass('displaynone');
            }
        }

        function recentBntInit($target)
        {
            // 화면에 뿌려진 갯수
            var iDisplayCount = 0;
            // 보여지는 style
            var sDisplay = '';
            var iIdx = 0;
            //
            var iDisplayNoneIdx = 0;

            var nodes = $target.find('.xans-record-').each(function()
            {
                sDisplay = $(this).css('display');
                if (sDisplay != 'none') {
                    iDisplayCount++;
                } else {
                    if (iDisplayNoneIdx == 0) {
                        iDisplayNoneIdx = iIdx;
                    }

                }
                iIdx++;
            });

            var iRecentCount = nodes.length;
            var bBtnActive = iDisplayCount > 0;
            $('.xans-layout-productrecent .prev').unbind('click').click(function()
            {
                if (bBtnActive !== true) return;
                var iFirstNode = iDisplayNoneIdx - iDisplayCount;
                if (iFirstNode == 0 || iDisplayCount == iRecentCount) {
                    alert(__('최근 본 첫번째 상품입니다.'));
                    return;
                } else {
                    iDisplayNoneIdx--;
                    $(nodes[iDisplayNoneIdx]).hide();
                    $(nodes[iFirstNode - 1]).removeClass('displaynone');
                    $(nodes[iFirstNode - 1]).fadeIn('fast');

                }
            }).css(
            {
                cursor : 'pointer'
            });

            $('.xans-layout-productrecent .next').unbind('click').click(function()
            {
                if (bBtnActive !== true) return;
                if ( (iRecentCount ) == iDisplayNoneIdx || iDisplayCount == iRecentCount) {
                    alert(__('최근 본 마지막 상품입니다.'));
                } else {
                    $(nodes[iDisplayNoneIdx]).fadeIn('fast');
                    $(nodes[iDisplayNoneIdx]).removeClass('displaynone');
                    $(nodes[ (iDisplayNoneIdx - iDisplayCount)]).hide();
                    iDisplayNoneIdx++;
                }
            }).css(
            {
                cursor : 'pointer'
            });

        }

    }
};

/**
 * 비동기식 데이터 - 최근본상품 총 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('RecentTotalCount');
CAPP_ASYNC_METHODS.RecentTotalCount = {
    __iRecentCount: null,

    __$target: CAPP_ASYNC_METHODS.$xansMyshopMain.find('.xans_myshop_main_recent_cnt'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }

        return false;
    },

    restoreCache: function()
    {
        var sCookieName = 'recent_plist';
        if (EC_SDE_SHOP_NUM > 1) {
            sCookieName = 'recent_plist' + EC_SDE_SHOP_NUM;
        }
        var re = new RegExp('(?:^| |;)' + sCookieName + '=([^;]+)');
        var aCookieValue = document.cookie.match(re);
        if (aCookieValue) {
            this.__iRecentCount = decodeURI(aCookieValue[1]).split('|').length;
        } else {
            this.__iRecentCount = 0;
        }
    },

    execute: function()
    {
        this.__$target.html(this.__iRecentCount);
    },

    getData: function()
    {
        if (this.__iRecentCount === null) {
            // this.isUse값이 false라서 복구되지 않았는데 이 값이 필요한 경우 복구
            this.restoreCache();
        }

        return this.__iRecentCount;
    }
};
/**
 * 비동기식 데이터 - 주문정보
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Order');
CAPP_ASYNC_METHODS.Order = {
    __iOrderCount: null,
    __iOrderTotalPrice: null,
    __iGradeIncreaseValue: null,

    __$target: $('#xans_myshop_bankbook_order_count'),
    __$target2: $('#xans_myshop_bankbook_order_price'),
    __$target3: $('#xans_myshop_bankbook_grade_increase_value'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {        
            if (this.__$target.length > 0) {
                return true;
            }
            
            if (this.__$target2.length > 0) {
                return true;
            }
            
            if (this.__$target3.length > 0) {
                return true;
            }            
        }
        
        return false;        
    },

    setData: function(aData)
    {
        this.__iOrderCount = aData['total_order_count'];
        this.__iOrderTotalPrice = aData['total_order_price'];
        this.__iGradeIncreaseValue = Number(aData['grade_increase_value']);
    },

    execute: function()
    {
        this.__$target.html(this.__iOrderCount);
        this.__$target2.html(this.__iOrderTotalPrice);
        this.__$target3.html(this.__iGradeIncreaseValue);
    }
};
/**
 * 비동기식 데이터 - Benefit
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Benefit');
CAPP_ASYNC_METHODS.Benefit = {
    __aBenefit: null,
    __$target: $('.xans-myshop-asyncbenefit'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
        }

        return false;
    },

    setData: function(aData)
    {
        this.__aBenefit = aData;
    },

    execute: function()
    {
        var aFilter = ['group_image_tag', 'group_icon_tag', 'display_no_benefit', 'display_with_all', 'display_mobile_use_dc', 'display_mobile_use_mileage'];
        var __aData = this.__aBenefit;
        
        // 그룹이미지
        $('.myshop_benefit_group_image_tag').attr({alt: __aData['group_name'], src: __aData['group_image']});

        // 그룹아이콘
        $('.myshop_benefit_group_icon_tag').attr({alt: __aData['group_name'], src: __aData['group_icon']});

        if (__aData['display_no_benefit'] === true) {
            $('.myshop_benefit_display_no_benefit').removeClass('displaynone').show();
        }
        
        if (__aData['display_with_all'] === true) {
            $('.myshop_benefit_display_with_all').removeClass('displaynone').show();
        }
        
        if (__aData['display_mobile_use_dc'] === true) {
            $('.myshop_benefit_display_mobile_use_dc').removeClass('displaynone').show();
        } 
        
        if (__aData['display_mobile_use_mileage'] === true) {
            $('.myshop_benefit_display_mobile_use_mileage').removeClass('displaynone').show();
        }

        $.each(__aData, function(key, val) {
            if ($.inArray(key, aFilter) === -1) {
                $('.myshop_benefit_' + key).html(val);
            }
        });
    }    
};
/**
 * 비동기식 데이터 - 비동기장바구니 레이어
 */
CAPP_ASYNC_METHODS.aDatasetList.push('BasketLayer');
CAPP_ASYNC_METHODS.BasketLayer = {
    __sBasketLayerHtml: null,
    __$target: $('#ec_async_basket_layer_container'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        return false;
    },

    execute: function()
    {
        $.ajax({
            url: '/order/async_basket_layer.html?__popupPage=T',
            async: false,
            success: function(data) {
                var sBasketLayerHtml = data;
                var sBasketLayerStyle = '';
                var sBasketLayerBody = '';

                sBasketLayerHtml = sBasketLayerHtml.replace(/<script([\s\S]*?)<\/script>/gi,''); // 스크립트 제거
                sBasketLayerHtml = sBasketLayerHtml.replace(/<link([\s\S]*?)\/>/gi,''); // 옵티마이져 제거

                var regexStyle = /<style([\s\S]*?)<\/style>/; // Style 추출
                if (regexStyle.exec(sBasketLayerHtml) != null) sBasketLayerStyle = regexStyle.exec(sBasketLayerHtml)[0];

                var regexBody = /<body[\s\S]*?>([\s\S]*?)<\/body>/; // Body 추출
                if (regexBody.exec(sBasketLayerHtml) != null) sBasketLayerBody = regexBody.exec(sBasketLayerHtml)[1];

                CAPP_ASYNC_METHODS.BasketLayer.__sBasketLayerHtml = sBasketLayerStyle + sBasketLayerBody;
            }
        });
        this.__$target.html(this.__sBasketLayerHtml);
    }
};
/**
 * 비동기식 데이터 - Benefit
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Grade');
CAPP_ASYNC_METHODS.Grade = {
    __aGrade: null,
    __$target: $('.xans-myshop-asyncbenefit'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }
        }

        return false;
    },

    setData: function(aData)
    {
        this.__aGrade = aData;
    },

    execute: function()
    {
        var __aData = this.__aGrade;
        var aFilter = ['bChangeMaxTypePrice', 'bChangeMaxTypePriceAndCount', 'bChangeMaxTypePriceOrCount', 'bChangeMaxTypeCount'];

        var aMaxDisplayJson = {
            "bChangeMaxTypePrice": [
                {"sId": "sChangeMaxTypePriceArea"}
            ],
            "bChangeMaxTypePriceAndCount": [
                {"sId": "sChangeMaxTypePriceAndCountArea"}
            ],
            "bChangeMaxTypePriceOrCount": [
                {"sId": "sChangeMaxTypePriceOrCountArea"}
            ],
            "bChangeMaxTypeCount": [
                {"sId": "sChangeMaxTypeCountArea"}
            ]
        };

        if ($('.sNextGroupIconArea').length > 0) {
            if (__aData['bDisplayNextGroupIcon'] === true) {
                $('.sNextGroupIconArea').removeClass('displaynone').show();
                $('.myshop_benefit_next_group_icon_tag').attr({alt: __aData['sNextGrade'], src: __aData['sNextGroupIcon']});
            } else {
                $('.sNextGroupIconArea').addClass('displaynone');
            }
        }

        var sIsAutoGradeDisplay = "F";
        $.each(__aData, function(key, val) {
            if ($.inArray(key, aFilter) === -1) {
                return true;
            }
            if (val === true) {
                if ($('#'+aMaxDisplayJson[key][0].sId).length > 0) {
                    $('#' + aMaxDisplayJson[key][0].sId).removeClass('displaynone').show();
                }
                sIsAutoGradeDisplay = "T";
            }
        });
        if (sIsAutoGradeDisplay == "T" && $('#sGradeAutoDisplayArea .sAutoGradeDisplay').length > 0) {
            $('#sGradeAutoDisplayArea .sAutoGradeDisplay').addClass('displaynone');
        }

        $.each(__aData, function(key, val) {
            if ($.inArray(key, aFilter) === -1) {
                if ($('.xans-member-var-' + key).length > 0) {
                    $('.xans-member-var-' + key).html(val);
                }
            }
        });
    }    
};
/**
 * 비동기식 데이터 - 비동기장바구니 레이어
 */
CAPP_ASYNC_METHODS.aDatasetList.push('MobileMutiPopup');
CAPP_ASYNC_METHODS.MobileMutiPopup = {
    __$target: $('div[class^="ec-async-multi-popup-layer-container"]'),

    isUse: function()
    {
        if (this.__$target.length > 0) {
            return true;
        }
        return false;
    },

    execute: function()
    {
        for (var i=0; i < this.__$target.length ; i++) {
            $.ajax({
                url: '/exec/front/popup/AjaxMultiPopup?index='+i,
                data : EC_ASYNC_MULTI_POPUP_OPTION[i],
                dataType: "json",
                success : function (oResult) {
                    switch (oResult.code) {
                        case '0000' :
                            if (oResult.data.length < 1) {
                                break;
                            }
                            $('.ec-async-multi-popup-layer-container-' + oResult.data.html_index).html(oResult.data.html_text);
                            if (oResult.data.type == 'P') {
                                BANNER_POPUP_OPEN.setPopupSetting();
                                BANNER_POPUP_OPEN.setPopupWidth();
                                BANNER_POPUP_OPEN.setPopupClose();
                            } else {
                                /**
                                 * 이중 스크롤 방지 클래스 추가(비동기) 
                                 *
                                 */
                                $('body').addClass('eMobilePopup');
                                $('body').width('100%');

                                BANNER_POPUP_OPEN.setFullPopupSetting();
                                BANNER_POPUP_OPEN.setFullPopupClose();
                            }
                            break;
                        default :
                            break;
                    }
                },
                error : function () {
                }
            });
        }
    }
};
/**
 * 비동기식 데이터 - 좋아요 상품 갯수
 */
CAPP_ASYNC_METHODS.aDatasetList.push('MyLikeProductCount');
CAPP_ASYNC_METHODS.MyLikeProductCount = {
    __iMyLikeCount: null,

    __$target: $('#xans_myshop_like_prd_cnt'),

    isUse: function()
    {
        if (this.__$target.length > 0 && SHOP.getLanguage() === 'ko_KR') {
            return true;
        }

        return false;
    },

    setData: function(sData)
    {
        this.__iMyLikeCount = Number(sData);
    },

    execute: function()
    {
        if (SHOP.getLanguage() === 'ko_KR') {
            this.__$target.html(this.__iMyLikeCount + '개');
        }
    }
};
/**
 * 라이브 링콘 on/off이미지
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Livelinkon');
CAPP_ASYNC_METHODS.Livelinkon = {
    __$target: $('#ec_livelinkon_campain_on'),
    __$target2: $('#ec_livelinkon_campain_off'),

    isUse: function()
    {
        if (this.__$target.length > 0 && this.__$target2.length > 0) {
            return true;
        }
        return false;
    },

    execute: function()
    {
        var sCampaignid = '';
        if (EC_ASYNC_LIVELINKON_ID != undefined) {
            sCampaignid = EC_ASYNC_LIVELINKON_ID
        }
        $.ajax({
            url: '/exec/front/Livelinkon/Campaignajax?campaign_id='+sCampaignid,
            async: false,
            success: function(data) {
                if (data == 'on') {
                    CAPP_ASYNC_METHODS.Livelinkon.__$target.removeClass('displaynone').show();
                    CAPP_ASYNC_METHODS.Livelinkon.__$target2.removeClass('displaynone').hide();
                } else if (data == 'off') {
                    CAPP_ASYNC_METHODS.Livelinkon.__$target.removeClass('displaynone').hide();
                    CAPP_ASYNC_METHODS.Livelinkon.__$target2.removeClass('displaynone').show();
                } else {
                    CAPP_ASYNC_METHODS.Livelinkon.__$target.removeClass('displaynone').hide();
                    CAPP_ASYNC_METHODS.Livelinkon.__$target2.removeClass('displaynone').hide();
                }
            }
        });
    }
};
/**
 * 비동기식 데이터 - 마이쇼핑 > 주문 카운트 (주문 건수 / CS건수 / 예전주문)
 */
CAPP_ASYNC_METHODS.aDatasetList.push('OrderHistoryCount');
CAPP_ASYNC_METHODS.OrderHistoryCount = {
    __sTotalOrder: null,
    __sTotalOrderCs: null,
    __sTotalOrderOld: null,

    __$target: $('#ec_myshop_total_orders'),
    __$target2: $('#ec_myshop_total_orders_cs'),
    __$target3: $('#ec_myshop_total_orders_old'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }

            if (this.__$target2.length > 0) {
                return true;
            }

            if (this.__$target3.length > 0) {
                return true;
            }
        }

        return false;
    },

    setData: function(aData)
    {
        this.__sTotalOrder = aData['total_orders'];
        this.__sTotalOrderCs = aData['total_orders_cs'];
        this.__sTotalOrderOld = aData['total_orders_old'];

    },

    execute: function()
    {
        this.__$target.html(this.__sTotalOrder);
        this.__$target2.html(this.__sTotalOrderCs);
        this.__$target3.html(this.__sTotalOrderOld);
    }
};
$(document).ready(function()
{
	CAPP_ASYNC_METHODS.init();
});
