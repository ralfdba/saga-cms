<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<center>
<footer class="blockquote-footer">
Sitio desarrollado sobre&nbsp;
    <a href="http://www.netstream.cl" target="_blank">
    <?php echo $this->config->item('sistema');?>&nbsp;
    <?php echo $this->config->item('version_ns');?></a> - Page rendered in <strong>{elapsed_time}</strong> seconds. 
    <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>'
    . CI_VERSION . '</strong>' : '' ?>
</footer>
</center>
</div>
<script src=<?=base_url("assets/js/jquery-3.3.1.min.js")?>></script>
<script src=<?=base_url("assets/js/bootstrap.min.js")?>></script>

</body>
</html>