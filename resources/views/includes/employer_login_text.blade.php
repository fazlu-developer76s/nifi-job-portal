@if(!Auth::user() && !Auth::guard('company')->user())
<div class="emploginbox">
		<div class="usrintxt">
		<div class="titleTop">			
           <h3>{{__('Are You Looking For Candidates!')}}</h3>
			<h4>{{__('Post a Job Today')}}</h4>
        </div>
		<p>Are you looking for a new Candidates ? Post a job today Today,  to reach a vast pool of potential candidates. You can also consider hiring a recruitment agency to help you find the best fit for your organization. Make sure to clearly outline the job requirements, responsibilities, and benefits to attract the right candidates..</p>
		<div class="viewallbtn"><a href="{{route('register')}}">{{__('Post a Job')}}</a></div>
		</div>		
</div>
@endif