<template>
    <div>
        <form enctype="multipart/form-date">
            <div class="form-group">
                <label>Name of Album</label>
                <input type="text" name="name" class="form-control" maxLength="15">
            </div>
            <div class="form-group">
                <label>Album Description</label>
                <textarea name="description" class="form-control" maxLength="200"></textarea>
            </div>
            <div class="form-group">
                <label>Album Category</label>
                <select class="form-control">
                    <option></option>
                </select>
            </div>
            <div class="form-group">
                <label>Album Cover</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary">Create Album</button>
            </div>
        </form>
    </div>
</template>