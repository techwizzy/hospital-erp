<div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
         <?php if( $this->session->flashdata('msg')) { ?>
               <div class="alert alert-success">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?=  $this->session->flashdata('msg') ?></ul>
                        </div>
             <?php } ?>
          <div class="panel panel-primary">
             <div class="panel-heading"><h4>New Purchase order</h4></div>
            <div class="panel-body">
                         <?php  echo form_open('purchase/add_to_cart'); ?>
                               <table class="table table-bordered" style="border-bottom: 2px solid #B2D8D8">
                                  <tr>
                                     <td>
                                      <div class="form-group">
                                      <label class="col-sm-6 control-label">Order #:</label>
                                      <div class="col-sm-6">
                                          
                                        <input  type="text" class="form-control"  id="code" name="code" style="border:none;background-color:#FAFBFA; color:#66CC26; font-weight:bold" readonly />
                                      </div>
                                    </div><!--/form-group--> 
                                   </td>
                                    <td><div class="form-group">
                                      <label class="col-sm-6 control-label">Created By:</label>
                                      <div class="col-sm-6">
                                      <input  type="text" class="form-control" value=" <?php echo $this->session->userdata('Username'); ?>" name="agent" style="border:none;background-color:#FAFBFA; color:#419010; font-weight:bold" readonly />
                                      </div>
                                    </div><!--/form-group--> 
                                   </td>
                                 </tr>
                                 <tr>
                                 <td>
                                  <div class="form-group">
                                  <label class="col-sm-6 control-label">Supplier Name</label>
                                  <div class="col-sm-6">
                                    <input  type="text" class="form-control" value="<?php echo $this->session->userdata('supplier'); ?>"  name="supplier" id="supplier"  />
                                   <span style="color:red"><?php echo form_error('supplier'); ?></span>
                                  </div>
                                </div><!--/form-group--> 
                               
                               </td>
                                <td><div class="form-group">
                                  <label class="col-sm-6 control-label">Created on</label>
                                  <div class="col-sm-6">
                                    <input  type="text" class="form-control" value="<?php echo  date('l,d, F Y'); ?>" id="datepicker" name="orderdate"   />
                                  </div>
                                </div><!--/form-group--> 
                               </td>
                             </tr>
                            </table>
                         
                       
                         
                            <table class="table table-bordered display" style="margin:auto; width:935px;border:1px solid #cccccc">
                               <thead>
                                 <tr>
                                     <th>Product</th>
                                     <th>Code</th>
                                     <th>Unit </th>
                                     <th>qty </th>
                                     <th> price</th>
                                     <th>subtotal </th>
                                     <th> </th>
                                 </tr>
                               </thead>
                               <tbody>
                                  <tr class="odd gradeX">
                                      <td class="col-xs-4"> <input id="product" name="product" class="form-control" placeholder="please select a product" onfocus="setSupplier()" type="text"  /><span style="color:red"><?php echo form_error('product'); ?></span></td>
                                        <td  class="col-xs-2"><input type="text" onfocus=" setProductError()" class="form-control"  name="pcode" id="pcode"  /><span style="color:red"><?php echo form_error('pcode'); ?></span> </td>
                                     
                                      <td class="col-xs-2"> <select id="unit" name="unit" class="form-control select2"  >
                                             <option value="item">pieces</option>
                                           </select>
                                       </td>
                                       <td class="col-xs-1"><input type="text" onfocus=" setProductError()" class="form-control"  name="qty" id="qty" size="5"  /><span style="color:red"><?php echo form_error('qty'); ?></span> </td>
                                       <td class="col-xs-2"> <input type="text" name="price" autocomplete="off" class="form-control" onkeyup="subtotal();"    id="price"  /></td>
                                       <td class="col-xs-4"><input type="text" name="sub" id="sub" class="form-control" style="border:none;background-color:#FAFBFA; color:#419010;font-weight:bold"/></td>
                                       <td class="col-xs-2"><button type="submit" class="btn btn-success btn-xs"><i class="fa fa-check"></i>add</button>
                                      </td>
                                 </tr>
                             </tbody>
                           </table>
                         
                      <?php echo form_close() ?>
                      <hr>
                               
                     <?php  echo form_open('purchase/cart_update'); ?>
                         <table class="table table-bordered table-condensed  display" style="background-color:#ffffff; margin:auto; width:935px;">
                              <tr>
                                  <?php $i = 1; ?>
                                  <?php foreach ($this->cart->contents() as $items): ?>
                                  <?php echo form_hidden('rowToken', $items['rowid']); ?>
                                  <td><?php echo $items['name']; ?></td>
                                  <td><?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                    <strong><?php echo $option_value; ?><br />
                                       <?php endforeach; ?>
                                  </td>
                                          <td >  <?php echo form_input(array('name' => 'updateQty','id'=>'quant', 'value' => $items['qty'], 'maxlength="5" size="5" ','class'=>'form-control')); ?></td>
                                          <td><?php echo $this->cart->format_number($items['price']); ?></td>
                                          <td><?php echo $this->cart->format_number($items['subtotal']); ?></td>
                                          <td><a href="<?= site_url('purchase/remove_item/'.$items['rowid']); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</td>
                                        </tr>
                                        <?php $i++; ?>
                                         <?php endforeach; ?>
                                         <tr>
                                          <td colspan="2"> </td>
                                          <td>  <p><?php $js = 'onClick="cartError()"'; echo form_submit(array('id'=>'updateCart','value'=>'Update order', 'class'=>'btn btn-primary btn-xs'),$js); ?></p></td>
                                          <td><strong>Total</strong></td>
                                          <td >KES: <?php echo $this->cart->format_number($this->cart->total()); ?></td>
                                          <td></td>
                                        </tr>
                         </table>
                    <?php echo form_close() ?>
                    <?php  echo form_open('purchase/create_purchase_request'); ?>
                                                             
                                                              <input type="hidden" name="supplier" value=" <?php echo $this->session->userdata('supplier'); ?>">
                                                              <input type="hidden" name="total" value="<?php echo $this->cart->total(); ?>">
                                                               <input type="hidden" name="agent" value=" <?php echo $this->session->userdata('salesperson'); ?>">
                                                                <input type="hidden" name="ex_date" value=" <?php echo $this->session->userdata('expected'); ?>">
                     <table cellpadding="0" cellspacing="0" border="0" class="table    display">
                         <tbody>
                               <tr>
                                 <td ><strong>Grand Total</strong></td>
                                 <td><input type="text" value="<?php echo $this->cart->format_number($this->cart->total()); ?>" class="form-control" style="width:90px; font-weight:bold; color:#419010;" /></td>
                                 <td> </td>
                                 <td ><button id="nextButton" type="submit" onclick="setOrderError()"  class="btn btn-primary btn-icon"><b ><i class="fa fa-check" ></i>Create Purchase Order</button></td>
                                 <td><button type="button" onclick="clear_cart()"  id="btnCancel" class="btn btn-warning btn-icon"><i class="fa fa-close" ></i>Cancel order</button></td>
                                </tr>
                          </tbody>
                    </table>
                   <?php echo form_close() ?>
                 </div>
                </div>
              </section>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
          <script type="text/javascript">

   $(document).ready(function () {

     $( "#supplier" ).autocomplete({
            source: "<?php echo site_url('purchase/load_supplier'); ?>"

        });

             $( "#product" ).autocomplete({
              source: "<?php echo site_url('purchase/load_product'); ?>",
              focus: function( event, ui ) {
              $( "#product" ).val( ui.item.label );
                  return false;
                },
                select: function( event, ui ) {
                  $( "#product" ).val( ui.item.label );
                    $( "#pcode" ).val( ui.item.value );
              
                  return false;
                }
           });

          });
        </script>
<script type="text/javascript">

function setSupplier(){
   if(document.getElementById('supplier').value===""){
      alert("Please select a supplier first");

   }
}
</script>
<script type="text/javascript">


  function subtotal(){
    if(document.getElementById('price').value!="" && document.getElementById('qty').value!=""){
    data=parseFloat(document.getElementById('price').value);
    document.getElementById('sub').value=data*parseFloat(document.getElementById('qty').value);
  }
  }

  function clear_cart() {
  var result = confirm('Are you sure want to clear this order?');
  
  if(result) {
    window.location = "<?php echo base_url() ?>/index.php/purchase/cart_empty";
  }else{
    return false; // cancel button
  }
}
</script>