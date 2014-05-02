/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    
    function refreshSmallBasket(){
        
        $.ajax({
            url: 'mod/basket_small_refresh.php',
            datatype: 'json',
            success: function(data){
                $.each(data, function(k,v){
                    $("#basket_left ." + k + "span").text(v);
                });
            },
            error: function(data){
                alert("Error occured");
            }
        });
        
    }
    
    
    function refreshBigBasket(){
        $.ajax({
           url: 'mod/basket_view.php',
           dataType: 'html',
           success: function(data){
               $('#big_basket').html(data);
               initBinds();
           },
           error: function(data){
               alert('Error occured');
           }
        });
    }
    
    
    
   
    if($(".add_to_basket").length > 0){
        $(".add_to_basket").click(function(){
            
            var trigger=$(this);
            var param = trigger.attr("rel");
            var item = param.split("_");
            
            $.ajax({
                type: 'POST',
                url: '/mod/basket.php',
                datatype: 'json',
                data: ({id: item[0], jop: item[1]}),
                success: function(data){
                    
                },
                error: function(data){
                    alert("Error occured");
                }
                
            });
            return false;
            
        });
    }
    
    
    function initBinds(){
        
        if($('.remove_basket').length > 0){
            $('.remove_basket').bind('click', removeFromBasket);
        }
        if($('.update_basket').length > 0){
            $('.update_basket').bind('click', updateBasket);
        }
        
        if($('.fld_qty').bind('keypress', function(e){
            var code = e.keyCode ? e.keyCode : e.witch;
            if(code ==13){
                updateBasket();
            }
        }));
    }
    
    
    function updateBasket(){
        $('#frm_basket : input').each(function(){
           var sid = $(this).attr('id').split('-') ;
           var val = $(this).val();
           $ajax({
               type: 'POST',
               url: '/mod/basket_qty.php',
               data: ({id: sid[1], qty: val}),
               success: function(){
                   refreshSmallBasket();
                   refreshBigBasket();
               },
               error: function(){
                   alert('Error occured');
               }
           });
        });
    }
    
    
    function removeFromBasket(){
        var item = $(this).attr('rel');
        $.ajax({
            type: 'POST',
            url: '/mod/basket_remove.php',
            dataType: 'html',
            data:({id:item}),
            success: function(){
                refreshBigBasket();
                refreshSmallBasket();
            },
            error: function(){
                alert('Error occured');
            }
            
        });
    }
    

    
    
    
    
});
