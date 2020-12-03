<div id="message" class="tabs">
	<div class="rows">
		<div id="full" class="cells">
			<div id="box">
				<div id="content" style="background-image: url('{{ asset('public/asset/picture-default/bg-contact.png') }}');">
					<div id="absenM0" class="absenM"><img src="{{ asset('public/asset/picture-default/x.png') }}"></div>
					<div id="absenM1" class="absenM"></div>
					<div id="absenM2" class="absenM"></div>
					<div id="absenM3" class="absenM"></div>

					<div class="tabs">
						<div class="rows">
							<div class="cells v-top">
								<h2>Message</h2>
								<form method="post" action="{{ route('main.contact_us') }}">
									<div class="input">
										<label id="e_name"></label>
										<input type="text" name="name" placeholder="Name" required>
									</div>
									<div class="input">
										<label id="e_handphone"></label>
										<input type="text" name="handphone" placeholder="Handphone">
									</div>
									<div class="input">
										<label id="e_email"></label>
										<input type="text" name="email" placeholder="Email" required>
									</div>
									<div class="input">
										<label id="e_subject"></label>
										<input type="text" name="subject" placeholder="Subject" required>
									</div>
									<div class="input">
										<label id="e_message"></label>
										<textarea name="message" placeholder="Message" rows="4" required></textarea>
									</div>
									<div class="input">
										<label id="e_g-recaptcha-response"></label>
										<div class="g-recaptcha" data-sitekey="6LfHAS4UAAAAAIR34oekoJOvk9WzQhc6utDRv9vK" data-callback="g_recaptcha"></div>
										<button type="submit" class="btn-link blue">
											Submit
										</button>
									</div>
								</form>
								<div class="clearfix"></div>
							</div>
							<div class="cells v-top">
								<h2>Information</h2>
								<div id="inf" class="tabs">
									<div class="rows">
										<div class="cells">
											<img src="{{ asset('public/asset/picture-default/f-phone2.png') }}">
										</div>
										<div class="cells">
											<p>021 - 55663065</p>
										</div>
									</div>
									<div class="rows">
										<div class="cells">
											<img src="{{ asset('public/asset/picture-default/f-email2.png') }}">	
										</div>
										<div class="cells">
											<p>stainlesschs@gmail.com</p>
										</div>
									</div>
									<div class="rows">
										<div class="cells">
											<img src="{{ asset('public/asset/picture-default/f-pins2.png') }}">	
										</div>
										<div class="cells">
											<p>Jalan Manis Kiri No 88 Gudang P, Jatiuwung Tangerang</p>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div id="response" class="text-center"><label></label></div>
				</div>
			</div>
		</div>
	</div>
</div>