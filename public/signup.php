<?php
  // Initialize
  require_once('../private/initialize.php');

  //Check if this is a POST request. If it is, add the new member, log them in, and redirect to bird-staff/index.php
  if(is_post_request()) {
    // Create record using post parameters
    $args = $_POST['admin'];
    $admin = new Admin($args);
    $result = $admin->save();

    // Test result for errors, if none, add session message and redirect to bird-staff/index.php
    if($result === true) {
      $session->login($admin);
      $session->message('Welcome, newest member!');
      redirect_to(url_for('/bird-staff/index.php'));
    } else {
      // show errors
    }

  } else {
    // If this is not a POST request -> display the form
    $admin = new Admin;
  }

  // Set page title
  $page_title = 'Sign-Up';

  // Include the PUBLIC header
  include(SHARED_PATH . '/public_header.php');
?>

<!-- Setup the page using the same div structure as bird.php so that everything looks relatively the same -->
<div id="main">

  <div id="page">
    <div class="intro">
      <h2>Fill out the form below to become a member.</h2>
    </div>

    <!-- Display errors if $admin->save() failed -->
    <?php echo display_errors($admin->errors); ?>

    <!-- SIGN UP FORM: Everyone who signs up here will default to a member -->
    <form action="<?php echo url_for('/signup.php'); ?>" method="post">
      <dl>
        <dt>First name</dt>
        <dd><input type="text" name="admin[first_name]" value="<?php echo h($admin->first_name); ?>" /></dd>
      </dl>

      <dl>
        <dt>Last name</dt>
        <dd><input type="text" name="admin[last_name]" value="<?php echo h($admin->last_name); ?>" /></dd>
      </dl>

      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="admin[email]" value="<?php echo h($admin->email); ?>" /></dd>
      </dl>

      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="admin[username]" value="<?php echo h($admin->username); ?>" /></dd>
      </dl>

      <dl>
        <dt>Password</dt>
        <dd><input type="password" name="admin[password]" value="" /></dd>
      </dl>

      <dl>
        <dt>Confirm Password</dt>
        <dd><input type="password" name="admin[confirm_password]" value="" /></dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Become a Member" />
      </div>
    </form>

  </div>

</div>

<?php
  // Include the PUBLIC Footer
  include(SHARED_PATH . '/public_footer.php');
?> 