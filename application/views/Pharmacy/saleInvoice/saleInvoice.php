

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
									<label class="form-label">Customer Name</label>
                                    <input type="text" class="form-control" name="customerName" placeholder="Customer Name" required="required">
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
                 <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm text-nowrap custom-table table-sm text-nowrap" id="normalinvoice">
          <thead>
            <tr>
            <th class="text-center" width="220">Medicine Information <i class="text-danger">*</i></th>
            <th class="text-center" width="130">Batch<i class="text-danger"></i></th>
            <th class="text-center">Avail Qty</th>
            <th class="text-center" width="120">Expiry Date</th>
            <th class="text-center" width="100">Unit</th>
            <th class="text-center"  width="70">Quantity <i class="text-danger">*</i></th>
            <th class="text-center"  width="70">Box Qty <i class="text-danger">*</i></th>
            <th class="text-center" width="150">Price <i class="text-danger">*</i></th>
            <th class="text-center">Discount % </th>
      
            <th class="text-center" width="150">Total            </th>
            <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                       <tr>
                                        <td class="product_field">
                                            <input type="text" name="product_name" onkeyup="invoice_productList(1);" onkeypress="invoice_productList(1);" class="form-control productSelection" placeholder='Medicine Name' required="" id="product_name_1" tabindex="5">

                                            <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="product_id_1" />

                                            <input type="hidden" class="baseUrl" value="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo" />
                                        </td>
                                        <td>
                                            <select class="form-control select2" id="batch_id_1" name="batch_id[]"  onchange="product_stock_invoice(1)" tabindex="6" >
                                                <option></option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="available_quantity[]" class="form-control text-right available_quantity_1" value="0" readonly="" id="available_quantity_1"/>
                                        </td>
                                        <td id="expire_date_1">
                                        <input type="date" name="date" class="form-control text-right available_quantity_1" value="0"/>
                                        </td>
                                        <td>
                                            <input name="" id="" class="form-control text-right unit_1 valid" value="None" readonly="" aria-invalid="false" type="text">
                                        </td>
                                        <td>
                                            <input type="text" name="product_quantity[]" onkeyup="quantity_calculate_invoice(1),checkqty_invoice(1);" onchange="quantity_calculate_invoice(1);" class="total_qntt_1 form-control text-right valid_number" id="total_qntt_1" placeholder="0.00" min="0" tabindex="7" required/>
                                        </td>

                                         <td>
                                            <input type="text" name="box_quantity[]" onkeyup="quantity_calculate_invoice(1),checkqty_invoice(1);" onchange="quantity_calculate_invoice(1);" class=" form-control text-right valid_number" id="box_qty_1" placeholder="0.00" min="0" tabindex="-1" readonly="" />
                                            <input type="hidden" id="u_box_1" name="b_qty"/>
                                        </td>
                                        <td class="invoice_fields">
                                            <input type="text" name="product_rate[]" id="price_item_1" class="price_item1 price_item form-control text-right valid_number" tabindex="8" required="" onkeyup="quantity_calculate_invoice(1),checkqty_invoice(1);" onchange="quantity_calculate_invoice(1);" placeholder="0.00" min="0"/>
                                        </td>
                                        <!-- Discount -->
                                        <td>
                                            <input type="text" name="discount[]" onkeyup="quantity_calculate_invoice(1),checkqty_invoice(1);"  onchange="quantity_calculate_invoice(1);" id="discount_1" class="form-control text-right valid_number" min="0" tabindex="9" placeholder="0.00"/>

                                            <input type="hidden" value="" name="discount_type" id="discount_type_1">
                                        </td>


                                        <td class="invoice_fields">
                                            <input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_1" value="0.00" readonly="readonly" />
                                        </td>

                                        <td>
                                                <input id="total_tax0_1" class="total_tax0_1" type="hidden">
                                            <input id="all_tax0_1" class="total_tax0" type="hidden" name="tax[]">
                                           
                                            <!-- Tax calculate end-->

                                            <!-- Discount calculate start-->
                                           
                                                                                        <input id="total_tax1_1" class="total_tax1_1" type="hidden">
                                            <input id="all_tax1_1" class="total_tax1" type="hidden" name="tax[]">
                                           
                                            <!-- Tax calculate end-->

                                            <!-- Discount calculate start-->
                                           
                                                                                        <!-- Tax calculate end-->

                                            <!-- Discount calculate start-->
                                            <input type="hidden" id="total_discount_1" class="" />
                                            <input type="hidden" id="all_discount_1" class="total_discount dppr"/>
                                            <!-- Discount calculate end -->

                                          <button type="button" class="btn btn-danger-soft btn-sm" tabindex="10" onclick="deleteRowinvoice(this)"><i class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                       <tfoot>
                                    
                                    <tr>
                                        <td colspan="8" rowspan="2">
                                     
                                    </td>
                                        <td class="text-right" colspan="1"><b>Invoice Discount:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="invdcount" class="form-control text-right valid_number" name="invoice_discount" onkeyup="calculateSumInvoice();" onchange="calculateSumInvoice()" placeholder="0.00" tabindex="12"/>
                                            <input type="hidden" id="total_product_dis" value="">
                                           
                                        </td>
                                        <td> 
                                              <button  class="btn btn-info" type="button" onClick="addInputFieldInvoice('addinvoiceItem');" tabindex="11" id="add_invoice_item"><i class="fa fa-plus"></i>
                                            </button>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="1"  class="text-right"><b>Total Discount:</b></td>
                                        <td class="text-right">
                                           <input type="text" id="total_discount_ammount" class="form-control text-right valid_number" name="total_discount" value="0.00" readonly="readonly" />
                                              <input type="hidden" name="baseUrl" class="baseUrl" value="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo"/>
                                        </td>
                                    </tr>
                                                                         <tr class="hideableRow hiddenRow collapse" id="collapseExample">
                                       
                                <td class="text-right" colspan="9"><b>Vat </b></td>
                                <td class="text-right">
                                    <input id="total_tax_amount0" tabindex="-1" class="form-control text-right valid totalTax valid_number" name="total_tax0" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                                </td>
                               
                               
                                 
                                </tr>
                                                                              <tr class="hideableRow hiddenRow collapse" id="collapseExample">
                                       
                                <td class="text-right" colspan="9"><b>IGTA </b></td>
                                <td class="text-right">
                                    <input id="total_tax_amount1" tabindex="-1" class="form-control text-right valid totalTax valid_number" name="total_tax1" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                                </td>
                               
                               
                                 
                                </tr>
                                                                               
                              <tr>
                                         
                                        <td class="text-right" colspan="9"><b>Total VAT:</b></td>
                                        <td class="text-right">
                                            <input id="total_tax_amount" tabindex="-1" class="form-control text-right valid valid_number" name="total_tax" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                                        </td>
                                         <td><a class="btn btn-warning taxbutton text-center"  data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-angle-double-up"></i></a></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="9"  class="text-right"><b>Grand Total:</b></td>
                                        <td class="text-right">
                                             <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" value="0.00" readonly="readonly" />
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                         <tr>
                                    <td colspan="9"  class="text-right"><b>Previous:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="previous" class="form-control text-right valid_number" name="previous" value="0.00" readonly="readonly" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9"  class="text-right"><b>Net Total:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="n_total" class="form-control text-right" name="n_total" value="0" readonly="readonly" placeholder="" />
                                         <input type="hidden" id="txfieldnum" value="2"> 
                                    </td>
                                </tr>

                                        <td class="text-right" colspan="9"><b>Paid Amount:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="paidAmount"
                                            onkeyup="calculateSumInvoice()" class="form-control text-right valid_number" name="paid_amount" placeholder="0.00" tabindex="13"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="button" id="full_paid_invoice_tab" class="btn btn-warning" value="Full Paid" tabindex="14" onClick="full_paid_invoice()"/>

                                            <input type="submit" id="add_invoice" class="btn btn-success" name="add-invoice" value="Save" tabindex="15"/>
                                        </td>

                                        <td class="text-right" colspan="8"><b>Due Amount:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" value="0.00" readonly="readonly"/>
                                        </td>
                                    </tr>
                                    <tr id="change_m"><td class="text-right" colspan="9" id="ch_l"><b>Change:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="change" class="form-control text-right" name="change" value="" readonly="readonly"/>
                                        </td></tr>
                                </tfoot>
                            </table>
                        </div>
               
                </form>                    </div>
                    </div>
                    </div>
                    </div>


                 </div>
</div>



               
</div>

      <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/dist/js/popper.min.js"></script>
       <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>
      <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
      <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/metisMenu/metisMenu.min.js"></script>
      <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
      <!-- Third Party Scripts(used by this page)-->
     <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/sparkline/sparkline.min.js"></script>
       
        <!--Page Active Scripts(used by this page)-->
 
        <!--Page Scripts(used by all page)-->
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/dist/js/sidebar.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/chartJs/Chart.min.js"></script>
        <!--Page Active Scripts(used by this page)-->

    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/dataTables.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/dataTables.buttons.min.js"></script>
  
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/jszip.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/datatables/data-bootstrap4.active.js"></script>
      
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/moment/moment.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/daterangepicker/daterangepicker.js"></script>
        <!--Page Active Scripts(used by this page)-->
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/toastr/toastr.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="https://pharmacyv5.bdtask.com/pharmacare-9.4_demo/assets/plugins/vakata-jstree/dist/jstree.min.js"></script>
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
