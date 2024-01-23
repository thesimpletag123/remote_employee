
</div>
        <!-- starting footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md col-sm-6 col-6 wow fadeInUpBig" data-wow-duration=".25s" data-wow-offset="60">
                        <a href="/aboutus">About Us</a>
                        <a href="/contactus">Contact</a>
                        <a href="">Terms &amp; Conditions</a>
                    </div>
                    <div class="col-lg-2 col-md col-sm-6 col-6 wow fadeInUpBig" data-wow-duration=".5s" data-wow-offset="60">
                        <a href="https://youtube.com/channel/UCJufvVVE_wPhYquwjrFi2Qw" target="_blank"><i class="fab fa-youtube"></i> YouTube</a>
                        <a href="https://twitter.com/TREmployee" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                        <a href="https://www.linkedin.com/in/theremote-employee-6427492a2/" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
                    </div>
                    <div class="col-lg-5 col-md col-sm-6 col-12 wow fadeInUpBig" data-wow-duration=".75s" data-wow-offset="60">
                        <p>Subscribe to our newsletter</p>
                        <form>
                            <input type="email" placeholder="Email Address" name="">
                            <input type="submit" value="ok">
                        </form>
                    </div>
                    <div class="col-lg-3 col-md col-sm-6 col-12 wow fadeInUpBig" data-wow-duration="1s" data-wow-offset="60">
                        <p>Srijan Corporate, Tower 1, 1505, Sector V, 700091</p>
                        <p><a href="tel:+44 345 678 903">+91 968 121 5646</a></p>
                        <p><a href="mailto:theremoteemployee@gmail.com">theremoteemployee@gmail.com</a></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End footer -->
        
        
			
		@include('layouts.modals')
			
        
        <!-- starting button-top -->
        <div id="button-top">
            <i class="fa fa-angle-up fa-2x"></i>
        </div>
        <!-- End button-top -->
		<div class="cssloader" id="siteLoader" style="display:none">
            {{-- <div class="sh1"></div>
            <div class="sh2"></div> --}}
            <img src="{{asset('assets/images/480px-Loader.gif') }}" />
        </div>
	@include('layouts.script')
	@yield('pagescript')
    </body>
</html>