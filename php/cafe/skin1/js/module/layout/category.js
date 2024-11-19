/**
 * 카테고리 마우스 오버 이미지
 * 카테고리 서브 메뉴 출력
 */

$(function(){

    var methods = {
        aCategory    : [],
        aSubCategory : {},

        get: function()
        {
             $.ajax({
                url : '/exec/front/Product/SubCategory',
                dataType: 'json',
                success: function(aData) {

                    if (aData == null || aData == 'undefined') return;
                    for (var i=0; i<aData.length; i++)
                    {
                        var sParentCateNo = aData[i].parent_cate_no;

                        if (!methods.aSubCategory[sParentCateNo]) {
                            methods.aSubCategory[sParentCateNo] = [];
                        }

                        methods.aSubCategory[sParentCateNo].push( aData[i] );
                    }
                    makeSubShow();
                }
            });
        },

        getParam: function(sUrl, sKey) {

            var aUrl         = sUrl.split('?');
            var sQueryString = aUrl[1];
            var aParam       = {};

            if (sQueryString) {
                var aFields = sQueryString.split("&");
                var aField  = [];
                for (var i=0; i<aFields.length; i++) {
                    aField = aFields[i].split('=');
                    aParam[aField[0]] = aField[1];
                }
            }
            return sKey ? aParam[sKey] : aParam;
        },

        getParamSeo: function(sUrl) {
            var aUrl = sUrl.split('/');
            var len  = aUrl.length-2;

            return aUrl[len] ? aUrl[len] : null;
        },

        show: function(overNode, iCateNo, subId) {

            if (methods.aSubCategory.hasOwnProperty(iCateNo) === false) {
                return;
            }

            var aHtml = [];
            //aHtml.push('<ul>');
            $(methods.aSubCategory[iCateNo]).each(function() {
                aHtml.push('<li><a href="'+this.link_product_list+'">'+this.name+'</a></li>');
            });
            //aHtml.push('</ul>');


            var offset = $(overNode).offset();
            $(`<ul class="sub-menu collapse" id="${subId}">`)
                .appendTo(overNode)
                .html(aHtml.join(''));
        },

        
    };

    methods.get();

    function makeSubShow(){
        $('#menu-content >li').each(function(){
            let $this = $(this);
            let dataName = $this.attr('data-target');
            let FilteredName = dataName.replace(' ', '_');
            $this.attr('data-target', FilteredName);
            let subId = FilteredName.replace('#','');

            let iCateNo = Number(methods.getParam($this.attr('data-link'), 'cate_no'));
            
            methods.show($this, iCateNo, subId);
        });
    }

   /*
    $('.xans-layout-category li').on({
        mouseenter: function () {
            var $this = $(this).addClass('on'),
                iCateNo = Number(methods.getParam($this.find('a').attr('href'), 'cate_no'));

            if (!iCateNo) {
                iCateNo = Number(methods.getParamSeo($this.find('a').attr('href')));
            }

            if (!iCateNo) {
                return;
            }
            methods.show($this, iCateNo);
        },
        mouseleave: function () {
            $(this).removeClass('on');
            methods.close();
        }
    });
    */
});