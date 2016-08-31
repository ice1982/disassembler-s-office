<?php

class OrderAction extends BaseAction
{
    public function run()
    {
        Yii::app()->clientScript->registerScript('orderScript', "
                $.post( '" . $this->getController()->createUrl('orderAjax') . "', {}, function( data ) {
                    $( '#orderResult' ).html( data );
                });

                $( '#save' ).click( function() {
                    oSortable = $('.sortable').nestedSortable('toArray');

                    $( '#orderResult' ).slideUp( function(){
                        $.post( '" . $this->getController()->createUrl('orderAjax') . "', { sortable: oSortable }, function( data ) {
                            $( '#orderResult' ).html( data );
                            $( '#orderResult' ).slideDown();
                        });
                    });

                });
        ", CClientScript::POS_READY);

//        Yii::app()->clientScript->registerScript('orderAjaxScript', "
//                $( '.sortable' ).nestedSortable( {
//                    handle: 'div',
//                    items: 'li',
//                    toleranceElement: '> div',
//                    maxLevels: 1
//                } );
//        ", CClientScript::POS_READY);

        $this->getController()->render('order');
    }
} 