<header class="tutor-course-details-header tutor-mb-44" style="background: linear-gradient(to right, rgba(27, 182, 180, 0.1), rgba(27, 182, 180, 0.05)); padding: 2rem; border-radius: 10px; box-shadow: 0 4px 15px rgba(27, 182, 180, 0.1); transition: all 0.4s ease;">
	<div class="tutor-course-details-ratings tutor-animate-fade-in">
		<div class="tutor-ratings tutor-ratings-">
			<div class="tutor-ratings-stars">
				<span class="tutor-icon-star-line"></span>
				<span class="tutor-icon-star-line"></span>
				<span class="tutor-icon-star-line"></span>
				<span class="tutor-icon-star-line"></span>
				<span class="tutor-icon-star-line"></span>
			</div>
		</div>
	</div>
	
	<h1 class="tutor-course-details-title tutor-fw-bold tutor-color-black tutor-mt-12 tutor-mb-0 tutor-animate-fade-in" style="font-size: 2.5rem !important; color: #1BB6B4 !important; line-height: 1.2; animation-delay: 0.2s;">
		<span>تركيب هيكل الذراع الآلي</span>
	</h1>

	<div class="tutor-course-details-top tutor-mt-16 tutor-animate-fade-in" style="animation-delay: 0.3s;">
		<div class="tutor-row">
			<div class="tutor-col">
				<div class="tutor-meta tutor-course-details-info"> 
					<div>
						التصنيفات :
						<a href="http://localhost/course-category/electronics-robotics/?tutor-course-filter-category=7" style="color: #1BB6B4; font-weight: 500; transition: all 0.3s ease;">Electronics &amp; Robotics</a>
					</div>
				</div>
			</div>

			<div class="tutor-col-auto">
				<div class="tutor-course-details-actions tutor-mt-12 tutor-mt-sm-0">
					<a href="#" class="tutor-btn tutor-btn-ghost tutor-course-wishlist-btn tutor-mr-16 tutor-animate-fade-in" data-course-id="538" style="animation-delay: 0.4s; transition: all 0.3s ease; position: relative; overflow: hidden;">
						<i class="tutor-icon-bookmark-line tutor-mr-8"></i> قائمتي المفضلة
					</a>

					<a data-tutor-modal-target="tutor-course-share-opener" href="#" class="tutor-btn tutor-btn-ghost tutor-course-share-btn tutor-animate-fade-in" style="animation-delay: 0.5s; transition: all 0.3s ease; position: relative; overflow: hidden;">
						<span class="tutor-icon-share tutor-mr-8"></span> مشاركة
					</a>
				</div>
			</div>
		</div>
	</div>
</header>

<style>
/* Button Animation */
.tutor-btn {
    transition: all 0.3s ease !important;
    position: relative;
    overflow: hidden;
}

.tutor-btn:hover {
    background-color: #1BB6B4 !important;
    transform: translateY(-3px);
    color: white !important;
}

.tutor-btn::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.2);
    transition: all 0.5s ease;
}

.tutor-btn:hover::after {
    left: 100%;
}

/* Fade in animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.tutor-animate-fade-in {
    animation: fadeIn 0.6s ease forwards;
}

/* Enhanced header hover effect */
.tutor-course-details-header:hover {
    box-shadow: 0 6px 20px rgba(27, 182, 180, 0.15);
}

/* Star rating color */
.tutor-icon-star-line {
    color: #1BB6B4;
}
</style>
