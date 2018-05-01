<?php
if ( !is_admin() ) {
     wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
?>
<h3>Friend or Foe</h3>
<p>
Service account is not you.<br/>
He is just your friend. <br/>
Friend who likes to share his files with you.
</p>
<p>
So, you and your friend are different person, different account names.<br/>
He is only have 15 GB Google Drive quota, but you could be more.
</p>
<p>
All his shared files will be stored in your "Share with me" area (https://drive.google.com/drive/shared-with-me), while your main storage is My Drive (https://drive.google.com/drive/my-drive).<br/>
These 2 storages are seperated, you can access both but not with your friend (unless you gave him a permission/invitation).
</p>
<p>
If you want your folder inside My Drive (https://drive.google.com/drive/my-drive) can be viewed/listed by your friend (Service Account) in this plugin page, here's the steps:<br/>
1. Go to My Drive (https://drive.google.com/drive/my-drive), select folder and right click to show popup menu, choose and click "Share...".<br/>
<img src="<?php echo plugins_url( '/images/documentation/docserv-1.jpg', __FILE__ );?>" /><br/>
2. The popup will ask you the email address to give invitation, just copy and paste the Service Account name (eg: friend-123@mine-456789.iam.gserviceaccount.com).<br/>
<img src="<?php echo plugins_url( '/images/documentation/docserv-2.jpg', __FILE__ );?>" /><br/>
3. Click Send.<br/>
Now, when you reload this plugin page, the selected folder will be listed in the folder list.
</p>
<p>
To make folder inside the "Share with me" can be listed in "My Drive", just right click and click "Add to My Drive". The folder should be listed in both pages now.<br/>
<img src="<?php echo plugins_url( '/images/documentation/docserv-3.jpg', __FILE__ );?>" />
</p>
<p>
Done! :)
</p>