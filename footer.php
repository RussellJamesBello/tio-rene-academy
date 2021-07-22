				</div>
		</div>

		<br>

		<div class="ui small bottom fixed menu" style="background-color: #53b5ff;">
				
			<?php if(isset($_SESSION['id']))
				{ ?>
					<div class="header item" style="color: white;">
						Hello, <?php echo $_SESSION['whole_name'] ?>!
					</div>
				<?php } 
			?>

			<div class="right menu">
				<a href="#" class="item" style="color: white;"><i class="copyright outline icon"></i> All Rights Reserved</a>
			</div>
		</div>
	</div>
</body>
</html>