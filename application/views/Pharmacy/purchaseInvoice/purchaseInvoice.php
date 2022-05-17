
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo "Add New ".$pageHeading;?></h3>
				</div>
				<div class="card-body">
					<?php 
	          $attributes = array('class' => 'form form-horizontal form-bordered', 'id' => 'form');
	          echo form_open_multipart($loginRedirect,$attributes);
	        ?>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
                            <div class="form-group col-md-6">
									<label class="form-label">Manufacture</label>
									<?php 
		                $designationsOptionsJs = 'id="manufacturerName" class="form-control manufacturerName select2-show-search"';
		                echo form_dropdown('manufacturerName', $manufacturer, '', $designationsOptionsJs);
		              ?>
								</div>
								<div class="form-group col-md-6">
                                    <?php
                                      $date=date("Y-m-d");
                                    ?>
									<label class="form-label">Date *</label>
									<input type="date" class="form-control" name="date" placeholder="Date" value="<?php echo $date ;?>" readonly required="required">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Invoice No *</label>
									<input type="text" class="form-control" name="InvoiceNo" placeholder="Invoice No" required="required">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Details *</label>
									<input type="text" class="form-control" name="details" placeholder="Details" required="required">
								</div>
								<div class="form-group col-md-6">
                            <label class="form-label">Payment Type *</label>
								<?php 
									$days = array(
										'Cash Payment'			=> 'Cash Payment',
										'Card Payment'			=> 'Card Payment',
									);
                                    $designationsOptionsJs = 'id="day" class="form-control day select2-show-search" ';
                                    echo form_dropdown('day', $days, '', $designationsOptionsJs);
                                ?>
	                              </div>
						      </div>
                             </div>
					</div>



               
                </div>
                 <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                <th class="text-center"><nobr>Medicine Information<i class="text-danger">*</i></nobr></th> 
                                <th class="text-center"><nobr>Batch Id<i class="text-danger"></i></nobr></th>
                                <th class="text-center"><nobr>Expiry Date<i class="text-danger">*</i></nobr></th>
                                <th class="text-center"><nobr>Stock Qty</nobr></th>
                                <th class="text-center"><nobr>Box Pattern<i class="text-danger">*</i></nobr></th>
                                <th class="text-center"><nobr>Box Qty<i class="text-danger">*</i></nobr></th>
                                <th class="text-center"><nobr>Quantity <i class="text-danger">*</i></nobr></th>
                                <th class="text-center"><nobr>Manufacturer Price<i class="text-danger">*</i></nobr></th>
                                <th class="text-center"><nobr>Box MRP <i class="text-danger">*</i></nobr></th>
                                <th class="text-center"><nobr>Total Purchase Price</nobr></th>
                                <th class="text-center"><nobr>Action</nobr></th>
                                        </tr>
                                </thead>
                                <tbody id="emptbl">
                                    <tr>
                                        <td  id="col0" class="span3 manufacturer">
                                           <input type="text" name="product_name" required class="form-control product_name productSelection" onkeypress="product_list_purchase(1);" placeholder="Medicine Name" col0 tabindex="6" >

                                            <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId"/>

                                            <input type="hidden" class="sl" value="1">
                                        </td>
                                         <td id="col1">
                                                <input type="text" name="batch_id[]" id="batch_id_1" class="form-control text-right"  tabindex="7" placeholder="Batch Id" />
                                            </td>
                                            <td id="col2">
                                                <input type="text" name="expeire_date[]" id="expeire_date_1" class="form-control uidatepicker " tabindex="8"    placeholder="Expiry Date" onchange="checkExpiredate(1)" required/>
                                            </td>

                                       <td id="col3" class="wt">
                                                <input type="text" id="available_quantity_1" class="form-control text-right stock_ctn_1" placeholder="0.00" readonly/>
                                            </td>
                                            <td id="col4">
                                              
                                              <select name="box[]" class="form-control select2 select2-hidden" id="leaf_type_1" onchange="purchase_calculation(1),checkqty(1)" tabindex="9" aria-hidden="true" required="">
                                            <option value="" selected="selected">Select Leaf Type</option>
                                            <?php
                                        foreach($boxpattern as $box)
                                        {
                                        ?>
                                        <option value="<?php echo $box->medicne_numberPerBox;?>"><?php echo $box->medicine_BoxName.'('. $box->medicne_numberPerBox .')' ;?></option>
                                        <?php
                                        }
                                        ?>   
                                                                                    
                                     </select>
                                             <input type="hidden" name="" value="<option value=''>Select One</option><option value='20'>Leaf 1(150)</option><option value='30'>Leaf 2(150)</option><option value='40'>Leaf 3(150)</option><option value='1'>1:1(150)</option><option value='150'>1X15(150)</option> " id="leaf_type_dropdown">  
                                      
                                        </td>

                                             <td id="col5" class="text-right">
                                                <input type="text" name="box_quantity[]" id="box_quantity_1" class="form-control text-right store_cal_1 valid_number" onkeyup="purchase_calculation(1),checkqty(1);" onchange="purchase_calculation(1);" placeholder="0.00" value="" min="0" tabindex="10" required="required"/>
                                            </td>
                                        
                                            <td id="col6" class="text-right">
                                                <input type="text" name="product_quantity[]" id="quantity_1" class="form-control text-right store_cal_1" onkeyup="purchase_calculation(1),checkqty(1);" onchange="purchase_calculation(1);" placeholder="0.00" value="" min="0" required="required" readonly="" />
                                                <input type="hidden" name="unit_qty[]" id="unit_qty_1">
                                            </td>
                                            <td id="col7" class="test">
                                                <input type="text" name="product_rate[]" onkeyup="purchase_calculation(1),checkqty(1);" onchange="purchase_calculation(1);" id="product_rate_1" class="form-control product_rate_1 text-right valid_number" placeholder="0.00" value="" min="0" tabindex="11" required="required" />
                                            </td>
                                           <td id="col8">
                                               <input type="text" class="form-control valid_number" name="mrp[]" id="mrp_1" required tabindex="12" ></td>

                                            <td id="col9" class="text-right">
                                                <input class="form-control total_price text-right" type="text" name="total_price[]" id="total_price_1" value="0.00" readonly="readonly" />
                                            </td>
                                            <td id="col10">
                                                          <input type="button" value="Delete Row" onclick="deleteRows()" />  
                                            </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                        <tr>
                                        
                                        <td class="text-right" colspan="9"><b>Sub Total:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="sub_total"  class="text-right form-control" name="sub_total" placeholder="0.00" readonly="" />
                                        </td>
                                        <td><input type="button" value="Add Row" onclick="addRows()" /></td> 
                                    </tr>
                                    <tr>
                                        
                                        <td class="text-right" colspan="9"><b>Vat:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="vat" onkeyup="purchase_vatcalculation()" class="text-right form-control valid_number" name="vat" placeholder="0.00" tabindex="15" />
                                        </td>
                                        <td>
                                      
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="text-right" colspan="9"><b>Discount:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="discount" onkeyup="disoucnt_calculation()" class="text-right form-control valid_number" name="discount" placeholder="0.00" tabindex="16" />
                                        </td>
                                        <td>
                                      
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="text-right" colspan="9"><b>Grand Total:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="text-right form-control" name="grand_total_price" value="0.00" readonly="readonly" />
                                        </td>
                                        <td>
                                       
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="text-right" colspan="9"><b>Paid Amount:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="paid_amount" class="text-right form-control valid_number" name="paid_amount" onkeyup="paid_calculation()" placeholder="0.00" tabindex="18" />
                                        </td>
                                        <td>
                                       
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="text-right" colspan="9"><b>Due Amount:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="due_amount" class="text-right form-control" name="due_amount" placeholder="0.00" readonly="readonly" />
                                        </td>
                                        <td>
                                       
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
               
         <div class="form-group row">
                   <div class="col-md-6 text-right">
                   </div>
                     <div class="col-md-6 text-right">
                        <div class="">
                           <input type="button" id="full_paid_purchase_tab" class="btn btn-warning" value="Full Paid" tabindex="17" onClick="full_paid_purchase()"/>
                            <button type="submit"  class="btn btn-success" tabindex="19" id="save_purchase">
                                Save</button>

                        </div>
                       
                    </div>
                </div>
               

                </form>                    </div>
                    </div>
                    </div>
                    </div>


             <script type="text/javascript">

              function addRows()
              { 
                var table = document.getElementById('emptbl');
                var rowCount = table.rows.length;
                var cellCount = table.rows[0].cells.length; 
                var row = table.insertRow(rowCount);
                for(var i =0; i <= cellCount; i++){
                    var cell = 'cell'+i;
                    cell = row.insertCell(i);
                    var copycel = document.getElementById('col'+i).innerHTML;
                    cell.innerHTML=copycel;
                   
                }
            }
                function deleteRows()
                {
                    var table = document.getElementById('emptbl');
                    var rowCount = table.rows.length;
                    if(rowCount > '1')
                    {
                        var row = table.deleteRow(rowCount-1);
                        rowCount--;
                    }
                    else
                    {
                        alert('There should be atleast one row');
                    }
                }
            

    
    "use strict";
function full_paid_purchase() {
    var grandTotal = $("#grandTotal").val();
    $("#paid_amount").val(grandTotal);
    paid_calculation();
}
            </script>     </div>
</div>


                              <div class="overlay"></div>
                </div>
</div>

    
       
 
        <!--Page Scripts(used by all page)-->
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/dist/js/sidebar.js"></script>
   <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/moment/moment.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/daterangepicker/daterangepicker.js"></script>
        <!--Page Active Scripts(used by this page)-->
    
            <!--Page Active Scripts(used by this page)-->
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/dist/js/pages/tree-view.active.js"></script> <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/dist/js/print.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/modals/classie.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/modals/modalEffects.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/icheck/icheck.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/dist/js/pages/icheck.active.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/dist/js/pages/custom.js?v=1"></script>

    </body>
</html>



</body>
</html>
