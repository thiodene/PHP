<?php

// This function handles the saved values from the inventory count page mb_inv_count_view
// and stores them into the database INV_COUNT_ITEM
function saveInvCountValues($inv_level_items)
{
  // Take the Inventory values from their respective inventory level and decode with JSON
  $inv_level_items = json_decode($inv_level_items) ;
  
  // Save these values into the database (even Zeros)
  foreach($inv_level_items -> inv_values as $cur_inv_value)
  {
    
    // Get item id and inventory id for Qty_expected per item!
    $inv_level_id = $cur_inv_value -> inv_level_id ;
    $cc_item_id = $cur_inv_value -> cc_item_id ;
    $gn_prod_id = lookupColumnById("INV_COUNT_ITEM","UID",$cc_item_id,"LNK_PRODUCT") ;
    
    // Update the inventory per item
    $do_record = new doRecord("INV_COUNT_ITEM") ;
    $new_rec = array() ;
    $new_rec['LNK_INV_LEVEL'] = $cur_inv_value -> inv_level_id ;
    $new_rec['PACK_COUNT'] = $cur_inv_value -> pack_count ;
    $new_rec['SINGLES_COUNT'] = $cur_inv_value -> singles_count ;
    $new_rec['QTY_COUNTED'] = $cur_inv_value -> total_counted ;
    
    $do_record -> new_record = $new_rec ;
    $do_record -> id_column_val = $cur_inv_value -> cc_item_id ;
    $do_record -> update() ;
    unset($new_rec) ;
    unset($do_record) ;
  }
} // saveInvCountValues


?>
