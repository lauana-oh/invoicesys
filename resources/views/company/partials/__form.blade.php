<div class="form-group">
    <div class="form-group">
        <label for="name">Full name OR Company Name:</label>
        <input type="text" class="form-control" id="name" name="name"
               placeholder="Type company or person full name" value="{{ old("name", $company->name) }}">
        @error('name')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
    </div>

    <div class="form-row form-group">
        <div class="form-text col-3">
            <label for="nit">NIT:</label>
            <input type="number" class="form-control" name="nit"
                   id="nit" value="{{ old("nit", $company->nit) }}"
                   placeholder="Write NIT for this name">
            @error('nit')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
        </div>

        <div class="form-text col-6">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="{{ old("iva", $company->email) }}"
                   placeholder="company@email.com">
            @error('email')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
        </div>

        <div class="form-text col-3">
            <label for="phone">Phone number:</label>
            <input type="number" class="form-control" id="phone" name="phone"
                   value="{{old("phone",$company->phone)}}" placeholder="000 000 0000">
            @error('phone')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control mb-3" name="address" id="address" placeholder="Type address"
               value="{{old("address",$company->address)}}">
        @error('address')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
    </div>
</div>