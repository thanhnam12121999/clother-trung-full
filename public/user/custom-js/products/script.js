'use strict';

$(function () {
    let attributeIds = []
    let attrValues = []
    $(document).on('click', '.page-details .product-attributes__values label', function () {
        const input = $(this).parent().find($('input[type="radio"]'))
        const attrId = input.data('attr-id')
        const attrValueId = input.val()
        const attrIds = JSON.parse($('#attrIds').val())
        if (!attributeIds.includes(parseInt(attrId))) {
            attributeIds.push(parseInt(attrId))
        }
        const attr = attrValues.find((item) => item?.attr_id === parseInt(attrId))
        if (attr === undefined) {
            attrValues.push({
                attr_id: parseInt(attrId),
                attr_value_id: parseInt(attrValueId)
            })
        } else {
            const existValue = attrValues.some((item) => item?.attr_value_id === parseInt(attrValueId))
            if (!existValue) {
                attrValues = attrValues.map((item) => {
                    if (item?.attr_id === attr?.attr_id) {
                        const tempItem = Object.assign({}, item)
                        tempItem.attr_value_id = parseInt(attrValueId)
                        item = tempItem
                    }
                    return item
                })
            }
        }
        attributeIds.sort()
        attrIds.sort()
        if (JSON.stringify(attributeIds) === JSON.stringify(attrIds)) {
            const productId = $('#productId').val()
            $('.loader').css('display', 'block')
            $.ajax({
                url: `${BASE_URL}product/get-variant-price`,
                type: 'POST',
                dataType: 'json',
                data: {
                    product_id: productId,
                    variant: attrValues
                }
            }).done((result) => {
                $('.page-details .product-details #pd-price').html(`${result.variant_price}đ`)
                $('.page-details .product-details #variantPrice').val(result.variant_price)
                $('.page-details .product-details .pd-amount__text').html(`${result.variant_amount} sản phẩm có sẵn`)
                $('.page-details .product-details #variantAmount').val(result.variant_amount)
                $('.page-details .product-details #variantId').val(result.variant_id)
            }).always(() => {
                $('.loader').delay(1000)
                    .queue(function (next) { 
                        $(this).css('display', 'none'); 
                        next(); 
                    });
            })
        }
    })

    //copy code stack overflow
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minamountParam = getUrlParameter('minamount'),
        maxamountParam = getUrlParameter('maxamount');
    if (!minamountParam || !maxamountParam) {
        return;
    } else if (minamountParam.includes('$') && maxamountParam.includes('$')) {
        let minamountParamFormat = minamountParam.replace('$', '');
        let maxamountParamFormat = maxamountParam.replace('$', '');
        minamount.val('$' + minamountParamFormat);
        maxamount.val('$' + maxamountParamFormat);
        rangeSlider.slider({
            values: [minamountParamFormat, maxamountParamFormat]
        });
    }
})
