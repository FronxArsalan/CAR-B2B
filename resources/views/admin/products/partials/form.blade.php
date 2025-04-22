<div class="col-md-6">
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" placeholder="Name" required>
    </div>
</div>
<div class="col-md-6">
    <div class="mb-3">
        <label>Brand</label>
        <input type="text" name="brand" class="form-control" value="{{ old('brand', $product->brand ?? '') }}" placeholder="Brand"
            required>
    </div>
</div>
<div class="col-md-6">
    <div class="mb-3">
        <label>Size</label>
        <input type="text" name="size" class="form-control" value="{{ old('size', $product->size ?? '') }}" placeholder="Size"
            required>
    </div>
</div>
<div class="col-md-6">
    <div class="mb-3">
        <label>Type</label>
        <input type="text" name="type" class="form-control" value="{{ old('type', $product->type ?? '') }}" placeholder="Type">
    </div>
</div>
<div class="col-md-6">
    <div class="mb-3">
        <label>Season</label>
        <input type="text" name="season" class="form-control" value="{{ old('season', $product->season ?? '') }}" placeholder="Season">
    </div>
</div>
<div class="col-md-6">
    <div class="mb-3">
        <label>Price</label>
        <input type="number" step="0.01" name="price" class="form-control"
            value="{{ old('price', $product->price ?? '') }}" placeholder="Price" required>
    </div>
</div>
<div class="col-md-6">
    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? '') }}" placeholder="Stock"
            required>
    </div>
</div>
<div class="col-md-12">
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" placeholder="Description">{{ old('description', $product->description ?? '') }}</textarea>
    </div>
</div>
