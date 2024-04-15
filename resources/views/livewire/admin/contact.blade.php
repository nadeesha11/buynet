<div>
    <h5 class="text-brand mb-10">Contact form</h5>
    <h2 class="mb-10">Drop Us a Line</h2>
    <p class="text-muted mb-30 font-sm">Your email address will not be published. Required fields are marked *</p>
    <form wire:submit.prevent="submitForm" class="contact-form-style mt-30" >
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="input-style mb-20">
                    <input wire:model.defer="name" placeholder="First Name" type="text" />
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="input-style mb-20">
                    <input wire:model.defer="email" placeholder="Your Email" type="email" />
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="input-style mb-20">
                    <input wire:model.defer="telephone" placeholder="Your Phone" type="tel" />
                    @error('telephone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="input-style mb-20">
                    <input wire:model.defer="subject" placeholder="Subject" type="text" />
                    @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="textarea-style mb-30">
                    <textarea wire:model.defer="description" placeholder="Message"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button class="submit submit-auto-width" type="submit">Send message</button>
            </div>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('contact_success', () => {
            Swal.fire({
                title: 'Success!',
                text: 'Email sent.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('contact_failed', () => {
            Swal.fire({
                title: 'Failed!',
                text: 'Sorry, Something went wrong.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
</script>

