<footer>
  <div class="footer-div">
    <ul>
      <li><a href="">Home</a></li>
      <li><a href="">Music</a></li>
      <li><a href="">About Us</a></li>
      <li><a href="">Contact Us</a></li>
      <li><a href="<?=ROOT?>/login">Login</a></li>
    </ul>
  </div>
  <div class="footer-div">
    <form>
      <div class="form-group">
        <input class="form-control" type="text" placeholder="Search for music" name="find">
        <button class="btn">Search</button>
      </div>
    </form>
  </div>
  <div class="footer-div">
    <div class="follow-links">
      Follow Us:
      <br><br>
      <?php echo file_get_contents("assets/icons/customized/meta.svg"); ?>
      <?php echo file_get_contents("assets/icons/customized/tiktok.svg"); ?>
      <?php echo file_get_contents("assets/icons/customized/instagram.svg"); ?>
    </div>

  </div>
</footer>
</body>

</html>