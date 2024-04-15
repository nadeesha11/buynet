<!-- resources/views/livewire/admin/review-component.blade.php -->

<div class="comment-form">
    <h4 class="mb-15">Add a review</h4>
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <form wire:submit.prevent="submitReview" class="form-contact comment_form">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea wire:model="comment" class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                            @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input wire:model="name" class="form-control" name="name" id="name" type="text" placeholder="Name" />
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input wire:model="email" class="form-control" name="email" id="email" type="email" placeholder="Email" />
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input wire:model="website" class="form-control" name="website" id="website" type="text" placeholder="Website" />
                            @error('website') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="button button-contactForm">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('reviewAdded_success', () => {
            Swal.fire({
                title: 'Success!',
                text: 'Your review has been added.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('reviewAdded_fail', () => {
            Swal.fire({
                title: 'Success!',
                text: 'Your review has been added.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    });
</script>

