        </div>
      </div>
      <!-- CONTAINER END -->

      </div>

      

      <!-- FOOTER -->
      <footer class="footer">
        <div class="container">
          <div class="row align-items-center "> <!-- flex-row-reverse -->
            <div class="col-md-6 col-sm-12 "> <!-- col-md-12 col-sm-12 text-center -->
              Copyright © <?php echo date('Y');?> <a href="#"><?php echo HEX_APPLICATION_NAME;?></a>. All rights reserved.
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                Powered by
                <a href="https://www.hexeam.com/" target="_blank" style="display: inline-block;max-width: 100px;margin-right: 50px;margin-left: 10px;">
                    <img class="PoweredLogo" src="http://doctorbooking.hexeam.org/assets/images/backgrounds/hexeamLogo.png">
                </a>
            </div>
          </div>
        </div>
      </footer>
      <!-- FOOTER END -->
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    

    <!-- BOOTSTRAP JS -->
    <script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/bootstrap/js/popper.min.js"></script>

    <!-- SPARKLINE JS-->
    <script src="<?php echo base_url()?>assets/js/jquery.sparkline.min.js"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="<?php echo base_url()?>assets/js/circle-progress.min.js"></script>

    <!-- RATING STARJS -->
    <script src="<?php echo base_url()?>assets/plugins/rating/jquery.rating-stars.js"></script>

    <!-- CHARTJS CHART JS-->
    <script src="<?php echo base_url()?>assets/plugins/chart/Chart.bundle.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/chart/utils.js"></script>

    <!-- PIETY CHART JS-->
    <script src="<?php echo base_url()?>assets/plugins/peitychart/jquery.peity.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/peitychart/peitychart.init.js"></script>

    <!-- ECHART JS-->
    <script src="<?php echo base_url()?>assets/plugins/echarts/echarts.js"></script>

    <!-- SIDE-MENU JS-->
    <script src="<?php echo base_url()?>assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- CUSTOM SCROLLBAR JS-->
    <script src="<?php echo base_url()?>assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- SIDEBAR JS -->
    <script src="<?php echo base_url()?>assets/plugins/sidebar/sidebar.js"></script>

    <!-- APEXCHART JS -->
    <script src="<?php echo base_url()?>assets/js/apexcharts.js"></script>

    <!-- INDEX JS -->
    <script src="<?php echo base_url()?>assets/js/index1.js"></script>

    <!-- FILE UPLOADES JS -->
    <script src="<?php echo base_url()?>assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/fileuploads/js/file-upload.js"></script>

    <!-- DATA TABLE JS-->
    <script src="<?php echo base_url()?>assets/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/datatable/datatable.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/datatable/datatable-2.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/datatable/dataTables.responsive.min.js"></script>

    <!-- BOOTSTRAP-DATERANGEPICKER JS -->
    <script src="<?php echo base_url()?>assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- DATEPICKER JS -->
    <script src="<?php echo base_url()?>assets/plugins/date-picker/spectrum.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/date-picker/jquery-ui.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/input-mask/jquery.maskedinput.js"></script>

    <!-- TIMEPICKER JS -->
    <script src="<?php echo base_url()?>assets/plugins/time-picker/jquery.timepicker.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/time-picker/toggles.min.js"></script>

    <!-- INPUT MASK JS-->
    <script src="<?php echo base_url()?>assets/plugins/input-mask/jquery.mask.min.js"></script>

    <!-- SELECT2 JS -->
    <script src="<?php echo base_url()?>assets/plugins/select2/select2.full.min.js"></script>

    <!-- FORMELEMENTS JS -->
    <script src="<?php echo base_url()?>assets/js/form-elements.js"></script>

    <script src="<?php echo base_url()?>assets/plugins/wysiwyag/jquery.richtext.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/wysiwyag/wysiwyag.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/summernote/summernote-bs4.js"></script>
    <script src="<?php echo base_url()?>assets/js/summernote.js"></script>
    <script src="<?php echo base_url()?>assets/js/formeditor.js"></script>

    <!-- CUSTOM JS -->
    <script src="<?php echo base_url()?>assets/js/custom.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#hexLang').change(function(){
          var lang = $(this).val();
          window.location.href = '<?php echo base_url().'admin/switchLang/'?>'+lang;
        });
        $('.consultationSummary').richText();
        $('.medicines').richText();
        $('.labTests').richText();
        $('.bookingRemarks').richText();
      });
    </script>

  </body>
</html>