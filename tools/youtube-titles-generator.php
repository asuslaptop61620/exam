<?php include_once dirname(__FILE__)."/../admin/inc/config.php"; ?>
<?php 

//Site Setttings
$pageId = 6;
if (is_numeric($pageId) == true) {
    $sql = "SELECT * from pages WHERE id = :pageId";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':pageId',$pageId,PDO::PARAM_INT);
    $query->execute();
    $result=$query->fetch(PDO::FETCH_OBJ);
}
$ptitle = htmlentities($result->title);
$pcontent = base64_decode(htmlentities($result->content));
$pkeywords = htmlentities($result->meta_keywords);
$pdescription = htmlentities($result->meta_description);

?>

<?php include dirname(__FILE__)."/../inc/header.php"?>

 <!-- Titlebar
================================================== -->
<div class="single-page-header" data-background-image="<?php echo $root; ?>/assets/frontend/images/single-job.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST">
                    <div class="single-page-header-inner">
                    <div class="left-side">
                        <div class="header-details">
                            <h3>YT Titles Generator</h3>
                            <div class="intro-banner-search-form margin-top-95 mb-5">
                                <!-- Search Field -->
                                <div class="intro-search-field with-autocomplete hiddenifr">
                                    <label for="autocomplete-input" class="field-title ripple-effect">Video Title</label>
                                    <div class="input-with-icon">
                                        <input id="autocomplete-input" required type="text" name="video_title" placeholder="Please enter video title here">
                                        <i class="icon-brand-youtube"></i>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="intro-search-button">
                                    <button class="button ripple-effect" id="viewiframejs" name="submit" type="submit">Generate Video Title</button>
                                </div>
                            </div>
                            <span class="notes">Example : Lela</span>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="ad-space-768">
   <?php echo $bannerTop; ?>
</div>
<div class="container">
    <div class="row">
        <!-- Content -->
        <div class="col-xl-8 col-lg-8 content-right-offset">   
        
        <?php if(isset($_POST['submit'])){ ?>
            <div class="section padding-top-65 padding-bottom-70">
    			<div class="section-headline margin-bottom-30">
    				<h4>Generated Titles</h4>
    			</div>
    			<table class="basic-table">
    				<tbody><tr>
    					<th>#</th>
    					<th>Title</th>
    				</tr>
    				<?php
                        $search = trim($_POST['video_title']);
                        // if($search !== false)
                        // {
                           $titleList = generateTitles($search);
                           
                           $counter = 1;
                           foreach($titleList as $title)
                           {
                               echo "<tr>";
                               echo  "<td data-label='Column 1'>#{$counter}</td>";
                               echo "<td data-label='Column 2'>{$title}</td>";
                               echo "</tr>";
                               $counter++;
                           }
                        // }
                    ?>
    			</tbody></table>
    		</div>
        <?php  } ?>
            <div class="single-page-section">
                <h3 class="margin-bottom-25">About YT Titles Generator</h3>
                <?php echo $pcontent; ?>
            </div>
        </div>    
<?php include_once dirname(__FILE__)."/../inc/footer.php"; ?>