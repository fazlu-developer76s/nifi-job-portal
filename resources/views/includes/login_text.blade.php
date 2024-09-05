
<div class="userloginbox">
		<div class="usrintxt">
		<div class="titleTop">
           <h3>{{__('Are You Looking For Job!')}} </h3>
		   <h4>{{__('Search your desire Job')}}</h4>
        </div>
		<p>To search for your desired job, I recommend using a combination of online job boards, company websites, and professional networks. Start by making a list of job titles and companies that align with your skills, experience, and interests. Then, use job search platforms like LinkedIn, Glassdoor, or Indeed to search for these positions.  you'll increase your chances of finding your dream job..</p>
		
		@if(!Auth::user() && !Auth::guard('company')->user())
		<div class="viewallbtn"><a href="{{route('register')}}"> {{__('Get Started Today')}} </a></div>
		@else
		<div class="viewallbtn"><a href="{{url('my-profile')}}">{{__('Build Your CV')}} </a></div>
		@endif
		</div>
</div>
