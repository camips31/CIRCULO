		<div class="d-flex flex-column flex-root">
			<!--begin::Error-->
			<div class="error error-6 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url(<?Php echo $vParamsViewBackEndLayout['root_backend_media']; ?>error/bg6.jpg);">
				<!--begin::Content-->
				<div class="d-flex flex-column flex-row-fluid text-center">
					<h1 class="error-title font-weight-boldest text-white mb-12" style="margin-top: 10rem;">¡UPS!</h1>
					<p class="display-4 font-weight-bold text-white">La sesión ha expirado, por favor vuelva a ingresar con sus datos.</p>
                    <div class="display-4">
                        <a href="<?Php echo BASE_VIEW_URL; ?>auth" class="btn btn-dark">Ingresar Nuevamente</a>
                    </div>
				</div>
				<!--end::Content-->
			</div>
			<!--end::Error-->
		</div>