      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong> &copy; <?=Date('Y')?></strong> | Developed By Yash Jain
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- FastClick -->
<script src="<?=base_url('assets/adminlte/bower_components/fastclick/lib/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/adminlte/dist/js/adminlte.min.js');?>"></script>
<?=($this->session->flashdata('login_gagal')) ? '<script>Swal.fire("Failed", "Username/Password Incorrect !", "error")</script>' : '' ?>
<?=($this->session->flashdata('novoting')) ? '<script>Swal.fire("Failed", "No voting !", "error")</script>' : '' ?>
</body>
</html>
