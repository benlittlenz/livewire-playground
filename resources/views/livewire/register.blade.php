<div>
    {{$email}}
    <form wire:submit.prevent="register">
        <div>
            <label for="email">Email</label>
            <input
                wire:model="email"
                type="text"
                id="email"
                name="email">
            @error('email') <span> {{$message}}</span> @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input
                wire:model="password"
                type="password"
                id="password"
                name="Password">
                @error('password') <span> {{$message}}</span> @enderror
        </div>
        <div>
            <label for="passwordConfirmation<">Password Confirmation</label>
            <input
                wire:model="passwordConfirmation"
                type="password"
                id="passwordConfirmation"
                name="Password Confirmation">
        </div>

        <div>
            <input type="submit" value="Register">
        </div>
    </form>
</div>
