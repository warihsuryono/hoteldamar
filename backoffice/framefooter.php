								<?php include_once "footer_window_content.php"; ?>
							</td>
							<!-- right column (end) -->
						</tr>
					</table>
				</td>
			</tr>
			<!-- content (end) -->
			<!-- footer (begin) -->
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr class="ewFooterRow">
							<td background="images/footerbg.png" height="20">
								&nbsp;<!-- *** Note: Only licensed users are allowed to remove or change the following copyright statement. *** -->
								<font class="ewFooterText">&copy;<?php echo date("Y");?> HOTEL DAMAR. All rights reserved.</font>
								<!-- Place other links, for example, disclaimer, here -->
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- footer (end) -->
		</table>
	<script type="text/javascript">
		for(i=1;i<4;i++){
			try{
				if(document.getElementById("leftcolomid"+i).style.visibility=='hidden'){
					document.getElementById("leftcolomid"+i).style.position='absolute';
				}
			} catch (e) {
				i=5;
			}
		}
	</script>	
	</body>
</html>
