<div class="mb-3">
    <label for="name" class="form-label">Game Name</label>
    <input type="text" class="form-control" id="name" name="name" 
           value="{{ old('name', $game->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $game->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="difficulty" class="form-label">Difficulty</label>
    <select class="form-select" id="difficulty" name="difficulty" required>
        <option value="easy" {{ (old('difficulty', $game->difficulty ?? '') == 'easy' ? 'selected' : '' }}>Easy</option>
        <option value="moderate" {{ (old('difficulty', $game->difficulty ?? '') == 'moderate' ? 'selected' : '' }}>Moderate</option>
        <option value="difficult" {{ (old('difficulty', $game->difficulty ?? '') == 'difficult' ? 'selected' : '' }}>Difficult</option>
    </select>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="points" class="form-label">Points Reward</label>
        <input type="number" class="form-control" id="points" name="points" 
               value="{{ old('points', $game->points ?? '') }}" min="1" required>
    </div>
    <div class="col-md-6">
        <label for="carbon_saved" class="form-label">Carbon Saved (kg)</label>
        <input type="number" class="form-control" id="carbon_saved" name="carbon_saved" 
               value="{{ old('carbon_saved', $game->carbon_saved ?? '') }}" min="0" required>
    </div>
</div>

<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
           {{ old('is_active', isset($game) ? $game->is_active : true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Active Game</label>
</div>