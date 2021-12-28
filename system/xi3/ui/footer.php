<?php
require_once 'core/browser.php';
?>
<div class="mt-5 block-cta-1 primary-overlay"
	style="background-image: url('images/assurance.<?php get_browser_bgimage();?>')">
	<div class="container">
		<div class="row align-items-center justify-content-between">
			<div class="col-lg-<?php echo ($copyright? '12' : '7')?> mb-4 mb-lg-0">
				<h2 class="mb-3 mt-0 text-white">70% Discount for the Goverments Use!</h2>
				<p class="text-white">This is not an intrusion detection tool and we don't do any protection. If you need operational help, you can use other tools of us or find another tools around the world.</p>
			</div>

<?php if($copyright) {?>

		</div>
	</div>
</div>

<div class=" pt-5 text-center">
	<div class="col-12">
		<p>Copyright &copy; 2021 All rights reserved</p>
	</div>
</div>

<?php

} else {    ?>

			<div class="col-lg-4">
				<p class="mb-0">
					<a href="contact.php"
						class="btn btn-outline-white text-white btn-md btn-pill px-5 font-weight-bold btn-block">Contact
						Us</a>
				</p>
			</div>
		</div>
	</div>
</div>
<?php
    }
?>
