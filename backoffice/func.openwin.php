<script language="JavaScript">
	var detailsWindow;		
	function showCOA(coaid,koderid,descid,mode) {
	   detailsWindow = window.open("win_acc_coalist.php?mode="+mode+"&coaid="+coaid+"&koderid="+koderid+"&descid="+descid,"win_acc_coalist","width=800,height=600,top=300,scrollbars=yes");
	   detailsWindow.focus();   
	}	
	function showCalendar(textid,mode) {
	   detailsWindow = window.open("calendar.php?textid="+textid+"&mode="+mode,"calendar","width=260,height=250,top=300,scrollbars=yes");
	   detailsWindow.focus();   
	}
	function showMakanan(textid) {
	   detailsWindow = window.open("win_food_list.php?textid="+textid,"win_food_list","width=800,height=600,top=300,scrollbars=yes");
	   detailsWindow.focus();   
	}
	function showAdditional(textid) {
	   detailsWindow = window.open("win_additional_list.php?textid="+textid,"win_additional_list","width=800,height=600,top=300,scrollbars=yes");
	   detailsWindow.focus();   
	}
	function showMaterial(textid) {
	   detailsWindow = window.open("win_material_part_list.php?mode=material&textid="+textid,"win_material_part_list","width=800,height=600,top=300,scrollbars=yes");
	   detailsWindow.focus();   
	}
	function showQR_Vendor(textid,kode_pekerjaan) {
		detailsWindow = window.open("win_logistik_qr_vendor_list.php?textid="+textid+"&kode_pekerjaan="+kode_pekerjaan,"win_qr_vendor_list","width=800,height=600,top=300,scrollbars=yes");
		detailsWindow.focus();   
	}
	function showMR(textid) {
		detailsWindow = window.open("win_logistik_mr_list.php?textid="+textid,"win_logistik_mr_list","width=800,height=600,top=300,scrollbars=yes");
		detailsWindow.focus();   
	}
	function showPR(textid) {
		detailsWindow = window.open("win_workshop_pr_list.php?textid="+textid,"win_workshop_pr_list","width=800,height=600,top=300,scrollbars=yes");
		detailsWindow.focus();   
	}
	function showPermDana(textid,kode_pekerjaan) {
		detailsWindow = window.open("win_logistik_perm_dana_list.php?textid="+textid+"&kode_pekerjaan="+kode_pekerjaan,"win_logistik_perm_dana_list","width=800,height=600,top=300,scrollbars=yes");
		detailsWindow.focus();   
	}
	function showPO(textid,kode_pekerjaan,vendorid) {
		kode_pekerjaan="";
		vendorid="";
		detailsWindow = window.open("win_logistik_po_list.php?textid="+textid+"&kode_pekerjaan="+kode_pekerjaan+"&vendorid="+vendorid,"win_logistik_po_list","width=800,height=600,top=300,scrollbars=yes");
		detailsWindow.focus();   
	}
</script>