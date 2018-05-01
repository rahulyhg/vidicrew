<?php 
if(!function_exists('is_admin')){
     die('You do not have sufficient permissions to access this page.');
}
if ( !is_admin() ) {
     wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
$gdwpm_opsi_kategori = get_option('gdwpm_opsi_kategori_dr_folder'); 
$gdwpm_override_nonce = wp_create_nonce( "gdwpm_override_dir" );
$gdwpm_opsi_thumbs = get_option('gdwpm_img_thumbs');
if(!$gdwpm_opsi_thumbs){$gdwpm_opsi_thumbs = array('', '', '150', '150', 'false');}
$gdwpm_opsi_chunk = get_option('gdwpm_opsi_chunk');
?>
				<div class="ui-widget-content ui-corner-all" style="padding:1em;">	
				<form id="gdwpm_form_opsi_kategori" name="gdwpm_form_opsi_kategori" method="post">
				<p>
					<a onclick="gdwpm_cekbok_opsi_kategori_eksen();"><input type='checkbox' id='gdwpm_cekbok_opsi_kategori' name='gdwpm_cekbok_opsi_kategori' value='1' <?php echo $gdwpm_opsi_kategori;?> /></a> 
					Enable GDWPM Categories. (Google Drive folder names as Media Library category names)<br />
					&nbsp;<dfn>This option will create GDWPM Categories in your Media Library & Add Media filtering files.</dfn>
					<input type="hidden" name="gdwpm_opsi_kategori_nonce" value="<?php echo $gdwpm_override_nonce;?>">
				<p>
				<div id="gdwpm_folder_opsi_kategori_eksen" style="margin-left:15px;display: <?php if ($gdwpm_opsi_kategori == 'checked') { echo 'block;';}else{echo 'none;';}?>">
					<p>
					<dfn>Every time any Google Drive files added to Media Library, the folder name of these files will be category name of GDWPM Categories in the Media Library.
					</dfn>
					</p>
				</div>
				<button id="gdwpm_tombol_opsi_kategori" class="gdwpm_tombol_opsi">Save & Reload</button>
				</form>
				</div>
				<br />
				<?php
					$gdwpm_ukuran_preview = get_option('gdwpm_ukuran_preview'); //videnable = 2, vidplay = 3, videowid = 4, vidhei = 5 
					if(!$gdwpm_ukuran_preview || empty($gdwpm_ukuran_preview)){
						$gdwpm_ukuran_preview = array('640', '385');
						update_option('gdwpm_ukuran_preview', $gdwpm_ukuran_preview);
					}					
				?>
				<div class="ui-widget-content ui-corner-all" style="padding:1em;">	
					<p>Set predefined size for width and height of Google Drive single file preview shortcode. The default values are width = 640 px and height = 385 px.<br /><br />
						<label for="width" style="margin-left:25px;display:inline-block;width:60px;">Width: </label>
						<input type="number" id="gdwpm_ukuran_preview_lebar" name="gdwpm_ukuran_preview_lebar" min="50" max="9999" step="10" value="<?php echo $gdwpm_ukuran_preview[0];?>" size="5" /> px <small>(Pixel)</small><br />
						<label for="height" style="margin-left:25px;display:inline-block;width:60px;">Height: </label>
						<input type="number" id="gdwpm_ukuran_preview_tinggi" name="gdwpm_ukuran_preview_tinggi" min="20" max="9999" step="10" value="<?php echo $gdwpm_ukuran_preview[1];?>" size="5" /> px <small>(Pixel)</small><br />
						<dfn style="margin-left:90px;display:inline-block;">*Numeric only.</dfn><br /><br />
					the next generated Shortcode for file preview will be: <code id="sotkodeprev">[gdwpm id="G.DRIVEFILEID" w="<b><?php echo $gdwpm_ukuran_preview[0];?></b>" h="<b><?php echo $gdwpm_ukuran_preview[1];?></b>"]</code>
					</p>
				<p>
					<a onclick="gdwpm_cekbok_embed_video_eksen();"><input type='checkbox' id='gdwpm_cekbok_embed_video' name='gdwpm_cekbok_embed_video' value='1' <?php echo $gdwpm_ukuran_preview[2];?> /></a> 
					Use video player to embedding video files<br />
				</p>
				<div id="gdwpm_opsi_embed_video_eksen" style="margin-left:15px;display: <?php if ($gdwpm_ukuran_preview[2] == 'checked') { echo 'block;';}else{echo 'none;';}?>">
					<p style="margin-left:25px;">
					<dfn>This option will use the HTML <code>&lt;embed&gt;</code> element to embedding video whenever if your file was detected as video file. </dfn><br/>
					Set predefined value for Autoplay and width / height for video player size shortcode. The default values are width = 600 px and height = 370 px.<br /><br />
						<div style="display: flex; align-items: center;"><label for="autoplay" style="margin-left:35px;display:inline-block;width:100px;">Playing style: </label>
						<select style="width: 100px;" id="gdwpm_video_play_style" class="gdwpm_opsi_pilih"><option value="auto" <?php if($gdwpm_ukuran_preview[3] == 'auto'){echo ' selected="selected"';}?>>Auto</option><option value="manual" <?php if($gdwpm_ukuran_preview[3] == 'manual'){echo ' selected="selected"';}?>>Manual</option></select></div><br />
						<label for="width" style="margin-left:35px;display:inline-block;width:100px;">Width: </label>
						<input type="number" id="gdwpm_ukuran_video_lebar" name="gdwpm_ukuran_video_lebar" min="50" max="1000" step="10" value="<?php echo $gdwpm_ukuran_preview[4];?>" size="5" /> px <small>(Pixel)</small><br />
						<label for="height" style="margin-left:35px;display:inline-block;width:100px;">Height: </label>
						<input type="number" id="gdwpm_ukuran_video_tinggi" name="gdwpm_ukuran_video_tinggi" min="20" max="1000" step="10" value="<?php echo $gdwpm_ukuran_preview[5];?>" size="5" /> px <small>(Pixel)</small><br />
						<dfn style="margin-left:145px;display:inline-block;">*Numeric only.</dfn><br /><br />
					the next generated embedding video Shortcode: <code id="sotkodevideo">[gdwpm id="G.DRIVEFILEID" video="<b><?php echo $gdwpm_ukuran_preview[3];?></b>" w="<b><?php echo $gdwpm_ukuran_preview[4];?></b>" h="<b><?php echo $gdwpm_ukuran_preview[5];?></b>"]</code>
					</p>
				</div>
				<p>
				</p>
				<button onclick="gdwpm_tombol_ukuran_preview_eksen();" id="gdwpm_tombol_ukuran_preview" class="gdwpm_tombol_opsi">Save</button>&nbsp;&nbsp;&nbsp; 
					<span style="display: none" id="gdwpm_tombol_ukuran_preview_gbr">
						<img src="<?php echo plugins_url( '/images/animation/loading-bar-image.gif', __FILE__ );?>" />
					</span>
					<span id="gdwpm_tombol_ukuran_preview_info"></span>
				</div>
<script type="text/javascript">
function gdwpm_cekbok_embed_video_eksen(){
	if (jQuery('#gdwpm_cekbok_embed_video').prop('checked')){
		document.getElementById("gdwpm_opsi_embed_video_eksen").style.display = "block";
	}else{
		document.getElementById("gdwpm_opsi_embed_video_eksen").style.display = "none";
	}
}
function gdwpm_tombol_ukuran_preview_eksen(){
		jQuery("#gdwpm_tombol_ukuran_preview_gbr").show();
		jQuery('#gdwpm_tombol_ukuran_preview_info').empty();
	if (jQuery('#gdwpm_cekbok_embed_video').prop('checked')){
		var gdwpm_cekbok_video = 'checked';
	}else{
		var gdwpm_cekbok_video = '';
	}
		var data = {
			action: 'gdwpm_on_action',
			gdwpm_override_nonce: '<?php echo $gdwpm_override_nonce; ?>',
			gdwpm_ukuran_preview_lebar: jQuery('#gdwpm_ukuran_preview_lebar').val() ,
			gdwpm_ukuran_preview_tinggi: jQuery('#gdwpm_ukuran_preview_tinggi').val(),
			gdwpm_cekbok_embed_video: gdwpm_cekbok_video,
			gdwpm_video_play_style: jQuery('#gdwpm_video_play_style').val(),
			gdwpm_ukuran_video_lebar: jQuery('#gdwpm_ukuran_video_lebar').val(),
			gdwpm_ukuran_video_tinggi: jQuery('#gdwpm_ukuran_video_tinggi').val()
		};
		jQuery.post(ajax_object.ajax_url, data, function(hasil) {
			jQuery('#sotkodeprev').empty();
			jQuery('#gdwpm_tombol_ukuran_preview_gbr').hide();
			var holder = jQuery('<div/>').html(hasil);
			jQuery('#gdwpm_tombol_ukuran_preview_info').html(jQuery('#info', holder).html());
			jQuery('#sotkodeprev').html(jQuery('#hasil', holder).html());
			var hasilvid = jQuery('#hasilvid', holder).html();
			if(hasilvid.length > 7){
				jQuery('#sotkodevideo').empty();
				jQuery('#sotkodevideo').html(hasilvid);
			}
		});
}

</script>
				<br />
				<div class="ui-widget-content ui-corner-all" style="padding:1em;">	
				<form id="gdwpm_form_opsi_thumbs" name="gdwpm_form_opsi_thumbs" method="post">
				<p>
					<a onclick="gdwpm_cekbok_opsi_thumbs_eksen();"><input type='checkbox' id='gdwpm_cekbok_opsi_thumbs' name='gdwpm_cekbok_opsi_thumbs' value='1' <?php echo $gdwpm_opsi_thumbs[0];?> /></a> 
					Auto Create Thumbnails. (Recommended)<br />
					&nbsp;<dfn>This option will create image thumbnail (not Google Drive file thumbnail) and the thumbnail data (file ID, image width, and image height) will be saved in the Google Drive file properties of the original image. All Thumbnails will be saved in the "gdwpm-thumbnails" folder.</dfn>
					<input type="hidden" name="gdwpm_opsi_thumbs_nonce" value="<?php echo wp_create_nonce( "gdwpm_thumbs_nonce" );?>">
				<p>
				<div id="gdwpm_opsi_thumbs_eksen" style="margin-left:15px;display: <?php if ($gdwpm_opsi_thumbs[0] == 'checked') { echo 'block;';}else{echo 'none;';}?>">
					<p>				
					<label for="thumbs_width" style="margin-left:25px;display:inline-block;width:77px;">Max Width: </label>
						<input type="number" id="gdwpm_thumbs_width" name="gdwpm_thumbs_width" min="50" max="300" step="5" value="<?php echo $gdwpm_opsi_thumbs[2];?>" size="3" /> px <small>(Pixel)</small><br />
					<label for="thumbs_height" style="margin-left:25px;display:inline-block;width:77px;">Max Height: </label>
						<input type="number" id="gdwpm_thumbs_height" name="gdwpm_thumbs_height" min="50" max="300" step="5" value="<?php echo $gdwpm_opsi_thumbs[3];?>" size="3" /> px <small>(Pixel)</small><br />
						<dfn style="margin-left:107px;display:inline-block;">*Numeric only.</dfn><br />
					<div style="display: flex; align-items: center;"><label for="thumbs_crop" style="margin-left:25px;display:inline-block;width:77px;">Crop: </label>
						<select style="width: 70px;" class="gdwpm_opsi_pilih" id="gdwpm_thumbs_crop" name="gdwpm_thumbs_crop"><option value="true" <?php if($gdwpm_opsi_thumbs[4] == 'true'){echo ' selected="selected"';}?>>Yes</option><option value="false" <?php if($gdwpm_opsi_thumbs[4] == 'false'){echo ' selected="selected"';}?>>No</option></select></div><br />
						<small>Note: if you change the API Key settings, this option will be reset automatically. <br/>For references: Your Media Settings (Settings >> Media) for Thumbnail size are Width: <?php echo get_option('thumbnail_size_w'); ?>, Height: <?php echo get_option('thumbnail_size_h'); ?>, & Crop: <?php if(get_option('thumbnail_crop')){echo 'Yes';}else{echo 'No';} ?>.</small>					
					</p>
				</div>
				<button id="gdwpm_tombol_opsi_thumbs" class="gdwpm_tombol_opsi">Save & Reload</button>
				</form>
				</div>
				<br />
				<div class="ui-widget-content ui-corner-all" style="padding:1em;">	
				<form id="gdwpm_form_opsi_chunkpl" name="gdwpm_form_opsi_chunkpl" method="post">
				<p>Google Drive Chunking Settings:<br/>					
					<label for="drivechunk_size" style="margin-left:25px;display:inline-block;width:85px;">Chunk Size: </label>
						<input type="number" id="gdwpm_drive_chunk_size" name="gdwpm_drive_chunk_size" min="1" max="99" step="1" value="<?php echo $gdwpm_opsi_chunk['drive']['chunk'];?>" size="2" /> MB <small>(Megabyte)</small><br />
					<label for="drivemax_retries" style="margin-left:25px;display:inline-block;width:85px;">Max Retries: </label>
						<input type="number" id="gdwpm_drive_chunk_retries" name="gdwpm_drive_chunk_retries" min="3" max="9" step="1" value="<?php echo $gdwpm_opsi_chunk['drive']['retries'];?>" size="2" /><br />
						<dfn style="margin-left:120px;display:inline-block;">*Numeric only.</dfn><br />
				</p>
				<p>
					<a onclick="gdwpm_cekbok_opsi_chunkpl_eksen();"><input type='checkbox' id='gdwpm_cekbok_opsi_chunkpl' name='gdwpm_cekbok_opsi_chunkpl' value='1' <?php echo $gdwpm_opsi_chunk['local']['cekbok'];?> /></a> 
					Enable chunking Local Server<br />
					&nbsp;<dfn>This option will split your file into chunks and upload these chunks to your local server and rejoin them back one by one. If uploads fail, it will retry to uploading the file starting with the last failed chunk. Once it's done, the current file will be chunked again and sending them to your Google Drive piece by piece. This temporary file automatically will be removed from your server. </dfn>
					<input type="hidden" name="gdwpm_opsi_chunkpl_nonce" value="<?php echo wp_create_nonce( "gdwpm_chunkpl_nonce" );?>">
				<p>
				<div id="gdwpm_folder_opsi_chunkpl_eksen" style="margin-left:15px;display: <?php if ($gdwpm_opsi_chunk['local']['cekbok'] == 'checked') { echo 'block;';}else{echo 'none;';}?>">
					<p>				
					<label for="localchunk_size" style="margin-left:25px;display:inline-block;width:85px;">Chunk Size: </label>
						<input type="number" id="gdwpm_local_chunk_size" name="gdwpm_local_chunk_size" min="50" max="9999" step="10" value="<?php echo $gdwpm_opsi_chunk['local']['chunk'];?>" size="4" /> kB <small>(Kilobyte)</small><br />
					<label for="localmax_retries" style="margin-left:25px;display:inline-block;width:85px;">Max Retries: </label>
						<input type="number" id="gdwpm_local_chunk_retries" name="gdwpm_local_chunk_retries" min="3" max="9" step="1" value="<?php echo $gdwpm_opsi_chunk['local']['retries'];?>" size="2" /><br />
						<dfn style="margin-left:120px;display:inline-block;">*Numeric only.</dfn><br />
						<small>Note: the Chunk Size should be less than your website's upload max filesize limit (your upload max filesize limit is <?php echo @ini_get('upload_max_filesize'); ?>).</small>					
					</p>
				</div>
				<button id="gdwpm_tombol_opsi_chunkpl" class="gdwpm_tombol_opsi">Save & Reload</button>
				</form>
				</div>
				<br />
				<?php 
				$gdwpm_override = get_option('gdwpm_override_dir_bawaan'); // cekbok, polder
				?>
				<div class="ui-widget-content ui-corner-all" style="padding:1em;">	
				<p>
					<a onclick="gdwpm_cekbok_opsi_override_eksen();"><input type='checkbox' id='gdwpm_cekbok_opsi_override' name='gdwpm_cekbok_opsi_override' value='1' <?php echo $gdwpm_override[0];?> /></a> 
					Google Drive as Default Media Upload Storage. (experimental) [Advanced users only]<br />
					&nbsp;<dfn>This option will change your default upload dir (<?php $def_upload_dir = wp_upload_dir(); echo $def_upload_dir['baseurl'];?>) to Google Drive. 
					This mean, when you upload files through default uploader (eg: Media >> Add New) it will automatically uploading your files to Google Drive.</dfn>
				</p>
				<div id="gdwpm_folder_opsi_override_eksen" style="margin-left:15px;display: <?php if ($gdwpm_override[0] == 'checked') { echo 'block;';}else{echo 'none;';}?>">
					<p>
						Google Drive folder name<br />
						<input type="text" id="gdwpm_folder_opsi_override_teks" name="gdwpm_folder_opsi_override_teks" value="<?php echo $gdwpm_override[1];?>" size="35" placeholder="Required (auto create if not exist)" />
					</p>
					<p>
						<input type='checkbox' id='gdwpm_cekbok_masukperpus_override' name='gdwpm_cekbok_masukperpus_override' value='1' <?php echo $gdwpm_override[2];?> /> Add to Media Library.
					</p>
				</div>
				<button onclick="gdwpm_tombol_opsi_override_eksen();" id="gdwpm_tombol_opsi_override" class="gdwpm_tombol_opsi">Save</button>&nbsp;&nbsp;&nbsp; 
				<span style="display: none" id="gdwpm_cekbok_opsi_override_gbr">
					<img src="<?php echo plugins_url( '/images/animation/loading-bar-image.gif', __FILE__ );?>" />
				</span>
				<span id="gdwpm_cekbok_opsi_override_info"></span>
				</div>
<script type="text/javascript">	
function gdwpm_cekbok_opsi_thumbs_eksen(){
	if (jQuery('#gdwpm_cekbok_opsi_thumbs').prop('checked')){
		document.getElementById("gdwpm_opsi_thumbs_eksen").style.display = "block";
	}else{
		document.getElementById("gdwpm_opsi_thumbs_eksen").style.display = "none";
	}
}

function gdwpm_cekbok_opsi_chunkpl_eksen(){
	if (jQuery('#gdwpm_cekbok_opsi_chunkpl').prop('checked')){
		document.getElementById("gdwpm_folder_opsi_chunkpl_eksen").style.display = "block";
	}else{
		document.getElementById("gdwpm_folder_opsi_chunkpl_eksen").style.display = "none";
	}
}

function gdwpm_cekbok_opsi_kategori_eksen(){
	if (jQuery('#gdwpm_cekbok_opsi_kategori').prop('checked')){
		document.getElementById("gdwpm_folder_opsi_kategori_eksen").style.display = "block";
	}else{
		document.getElementById("gdwpm_folder_opsi_kategori_eksen").style.display = "none";
	}
}

function gdwpm_cekbok_opsi_override_eksen(){
	if (jQuery('#gdwpm_cekbok_opsi_override').prop('checked')){
		document.getElementById("gdwpm_folder_opsi_override_eksen").style.display = "block";
	}else{
		document.getElementById("gdwpm_folder_opsi_override_eksen").style.display = "none";
	}
}
function gdwpm_tombol_opsi_override_eksen(){
	if (jQuery('#gdwpm_cekbok_opsi_override').prop('checked')){
		var gdwpm_cekbok = 'checked';
	}else{
		var gdwpm_cekbok = '';
	}
	if (jQuery('#gdwpm_cekbok_masukperpus_override').prop('checked')){
		var gdwpm_cekbok_masukperpus = 'checked';
	}else{
		var gdwpm_cekbok_masukperpus = '';
	}
		jQuery("#gdwpm_cekbok_opsi_override_gbr").show();
		jQuery('#gdwpm_cekbok_opsi_override_info').empty();
		var data = {
			action: 'gdwpm_on_action',
			gdwpm_override_nonce: '<?php echo $gdwpm_override_nonce; ?>',
			gdwpm_cekbok_opsi_value: gdwpm_cekbok ,
			gdwpm_folder_opsi_value: jQuery('#gdwpm_folder_opsi_override_teks').val() ,
			gdwpm_cekbok_masukperpus_override: gdwpm_cekbok_masukperpus
		};
		jQuery.post(ajax_object.ajax_url, data, function(hasil) {
			jQuery('#gdwpm_cekbok_opsi_override_gbr').hide();
			jQuery('#gdwpm_cekbok_opsi_override_info').html(hasil);
		});
}
</script>		
				<br />
<?php 
if(!isset($gdwpm_dummy_fol)){ $gdwpm_dummy_fol = get_option('gdwpm_dummy_folder');} 
?>
				<div class="ui-widget-content ui-corner-all" style="padding:1em;">	
					<p>
					<a onclick="gdwpm_cekbok_opsi_dummy_eksen();"><input type='checkbox' id='gdwpm_cekbok_opsi_dummy' name='gdwpm_cekbok_opsi_dummy' value='1' <?php echo $gdwpm_dummy_fol['status'];?> /></a>
					Enable Dummy Image URL. (Rewrite original Google Drive image URL)<br />
					&nbsp;<dfn>When you add an image into Media Library (auto or manually), this option will rewrite original Google Drive Image URL to internal dummy URL. (eg: "https://docs.google.com/uc?id=google-drive-file-id&export=view" will be something like "<?php echo $def_upload_dir['baseurl'];?>/<b><?php echo $gdwpm_dummy_fol['dirname'];?></b>/google-drive-file-id.jpg"). 
					<!-- With this feature (internal URLs), it makes more flexible to working with another plugins/themes. -->
					</dfn>
					</p>
					<div id="gdwpm_folder_opsi_dummy_eksen" style="margin-left:15px;display: <?php if ($gdwpm_dummy_fol['status'] == 'checked') { echo 'block;';}else{echo 'none;';}?>">
						<p>Your default dummy folder is <b><?php echo $gdwpm_dummy_fol['dirname'];?></b>.</p>
						<p style="display: flex; align-items: center;">Change default folder to: <select style="width: 150px;" name="gdwpm_opsi_dummy_dirdef" id="gdwpm_opsi_dummy_dirdef" class="gdwpm_opsi_pilih">
						<?php foreach($gdwpm_dummy_fol['dirlist'] as $dirfol){ ?>
						<option value="<?php echo $dirfol;?>" <?php if($dirfol == $gdwpm_dummy_fol['dirname']){echo ' selected="selected"';}?>><?php echo $dirfol;?></option>
						<?php } ?>
						</select>&nbsp; &nbsp; <small>If this selected virtual folder is not linked with any images, please feel free to <a onclick="gdwpm_cekbok_buang_dummy_eksen();" href="javascript:;">delete selected</a>.</small></p>
						<p>Or create a new: <input type="text" id='gdwpm_opsi_dummy_dirname' size="20" value=""/>. <small>No spaces, alpha numeric only.</small><br/><small>Note: htaccess, php file and physical folder for rewrite url are not needed by this option. For safety reason, this plugin only rename them by adding suffix with GDWPM-delete-manually.<br/>Please make sure that virtual dummy folder listed above did not exists in your uploads directory.</small>
						</p><br />
						<p>
						Choose default pattern:<br/>
						<input type="radio" name="gdwpm_opsi_dummy_pattern" value="1" <?php if($gdwpm_dummy_fol['pattern'] == '1'){echo 'checked';}?>> <b>#1</b> : <?php echo $def_upload_dir['baseurl'];?>/<i><?php echo $gdwpm_dummy_fol['dirname'];?></i>/<kbd>filename</kbd>~<b>google-drive-file-id</b>.jpg<br/>
						<br/>
						<input type="radio" name="gdwpm_opsi_dummy_pattern" value="2" <?php if($gdwpm_dummy_fol['pattern'] == '2'){echo 'checked';}?>> <b>#2</b> : <?php echo $def_upload_dir['baseurl'];?>/<i><?php echo $gdwpm_dummy_fol['dirname'];?></i>/<b>google-drive-file-id</b>/<kbd>filename</kbd>.jpg<br/>
						<br/>
						</p>
						<p>
						<input type='checkbox' id="gdwpm_opsi_dummy_pref" name="gdwpm_opsi_dummy_pref"  value='1' <?php echo $gdwpm_dummy_fol['pref'];?> />
						Replace filename with description. 
						<br/><small>*If there's no description provided, the original file name will be use as a filename.</small></p>
						
					</div>
					<button onclick="gdwpm_tombol_opsi_dummy_eksen();" id="gdwpm_tombol_opsi_dummy" class="gdwpm_tombol_opsi">Save & Reload</button>&nbsp;&nbsp;&nbsp; 
					<span style="display: none" id="gdwpm_cekbok_opsi_dummy_gbr">
						<img src="<?php echo plugins_url( '/images/animation/loading-bar-image.gif', __FILE__ );?>" />
					</span>
					<span id="gdwpm_cekbok_opsi_dummy_info"></span>
				</div>
<script type="text/javascript">		
function gdwpm_cekbok_buang_dummy_eksen(){
	jQuery("#gdwpm_cekbok_opsi_dummy_gbr").show();
	jQuery('#gdwpm_cekbok_opsi_dummy_info').empty();
	if (jQuery('#gdwpm_opsi_dummy_dirdef').val() == 'gdwpm_images'){
		jQuery('#gdwpm_cekbok_opsi_dummy_gbr').hide();
		jQuery('#gdwpm_cekbok_opsi_dummy_info').html('gdwpm_images cannot be deleted.');
	}else{
		var data = {
			action: 'gdwpm_on_action',
				gdwpm_override_nonce: '<?php echo $gdwpm_override_nonce; ?>',
				gdwpm_cekbok_buang_dummy: jQuery('#gdwpm_opsi_dummy_dirdef').val()
		};
		jQuery.post(ajax_object.ajax_url, data, function(hasil) {
			jQuery('#gdwpm_cekbok_opsi_dummy_gbr').hide();
			jQuery('#gdwpm_cekbok_opsi_dummy_info').html(hasil);
			location.reload();
		});
	}
}
function gdwpm_cekbok_opsi_dummy_eksen(){
	if (jQuery('#gdwpm_cekbok_opsi_dummy').prop('checked')){
		document.getElementById("gdwpm_folder_opsi_dummy_eksen").style.display = "block";
	}else{
		document.getElementById("gdwpm_folder_opsi_dummy_eksen").style.display = "none";
	}
}
function gdwpm_tombol_opsi_dummy_eksen(){
	if (jQuery('#gdwpm_cekbok_opsi_dummy').prop('checked')){
		var gdwpm_cekbok = 'checked';
	}else{
		var gdwpm_cekbok = '';
	}
	if (jQuery('#gdwpm_opsi_dummy_pref').prop('checked')){
		var gdwpm_cekbok_pref = 'checked';
	}else{
		var gdwpm_cekbok_pref = '';
	}
	jQuery("#gdwpm_cekbok_opsi_dummy_gbr").show();
	jQuery('#gdwpm_cekbok_opsi_dummy_info').empty();
	var data = {
		action: 'gdwpm_on_action',
			gdwpm_override_nonce: '<?php echo $gdwpm_override_nonce; ?>',
			gdwpm_cekbok_opsi_dummy: gdwpm_cekbok,
			gdwpm_opsi_dummy_dirdef: jQuery('#gdwpm_opsi_dummy_dirdef').val(),
			gdwpm_opsi_dummy_dirname: jQuery('#gdwpm_opsi_dummy_dirname').val(),
			gdwpm_opsi_dummy_pattern: jQuery('input[name=gdwpm_opsi_dummy_pattern]:checked').val(),
			gdwpm_opsi_dummy_pref: gdwpm_cekbok_pref
	};
	jQuery.post(ajax_object.ajax_url, data, function(hasil) {
		jQuery('#gdwpm_cekbok_opsi_dummy_gbr').hide();
		jQuery('#gdwpm_cekbok_opsi_dummy_info').html(hasil);
		location.reload();
	});
}
  jQuery(function() {
    jQuery( ".gdwpm_tombol_opsi" )
      .button({
      icons: {
        primary: "ui-icon-disk"
      }
    });
	jQuery('input').addClass("ui-corner-all");
	
	jQuery( ".gdwpm_opsi_pilih" )
	  .selectmenu();
  });		
</script>