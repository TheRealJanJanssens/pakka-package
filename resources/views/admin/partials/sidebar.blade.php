<div class="sidebar">
	<div class="sidebar-inner">
		<!-- ### $Sidebar Header ### -->
		<div class="sidebar-logo">
			<div class="peers ai-c fxw-nw">
				<div class="peer peer-greed">
					<a class='sidebar-link td-n' href="/">
						<div class="peers ai-c jc-c fxw-nw">
							<div class="peer">
								<div class="logo">
									@if(isset($settings['app_logo']))
						            	<img src="{{ config('image.app.public') }}{{ $settings['app_logo'] }}" alt="">
						            @else
						            	<img src="{{ config('placeholders.logo') }}" alt="">
						            @endif
								</div>
							</div>
<!--
							<div class="peer peer-greed">
								<h5 class="lh-1 mB-0 logo-text">AIM</h5>
							</div>
-->
						</div>
					</a>
				</div>
				<div class="peer">
					<div class="mobile-toggle sidebar-toggle">
						<a href="" class="td-n">
							<i class="ti-arrow-circle-left"></i>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- ### $Sidebar Menu ### -->
		<ul class="sidebar-menu scrollable pos-r">
			@include('pakka::admin.partials.menu')
		</ul>
	</div>
</div>