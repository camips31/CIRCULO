		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?Php echo $vParamsViewBackEndLayout['root_backend_plugins'];?>global/plugins.bundle.js"></script>
		<script src="<?Php echo $vParamsViewBackEndLayout['root_backend_js'];?>scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="<?Php echo $vParamsViewBackEndLayout['root_backend_js'];?>custom/iden.script.js"></script>
		<script src="<?Php echo $vParamsViewBackEndLayout['root_backend_js'];?>custom/authentication/sign-in.js"></script>
		<script src="<?Php echo $vParamsViewBackEndLayout['root_backend_js'];?>custom/authentication/sign-up.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>