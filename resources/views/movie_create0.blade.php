<form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
  @csrf

  <div>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
  </div>

  <div>
    <label for="synopsis">Synopsis:</label>
    <textarea name="synopsis" id="synopsis" required></textarea>
  </div>

  <div>
    <label for="image">Image:</label>
    <input type="file" name="image" id="image">
  </div>

  <div>
    <label for="release_date">Release Date:</label>
    <input type="date" name="release_date" id="release_date" required>
  </div>

  <div>
    <label for="rating">Rating:</label>
    <select name="rating" id="rating" required>
      <option value="U">U</option>
      <option value="PG">PG</option>
      <option value="12a">12a</option>
      <option value="12">12</option>
      <option value="15">15</option>
      <option value="18">18</option>
    </select>
  </div>

  <div>
    <label for="award_winning">Award Winning:</label>
    <input type="checkbox" name="award_winning" id="award_winning">
  </div>

  <div>
    <label for="genres">Genres:</label>
    <select name="genres[]" id="genres" multiple>
      @foreach($genres as $genre)
        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
      @endforeach
    </select>
  </div>

  <div>
    <label for="actors">Actors:</label>
    <select name="actors[]" id="actors" multiple>
      @foreach($actors as $actor)
        <option value="{{ $actor->id }}">{{ $actor->name }}</option>
      @endforeach
    </select>
  </div>

  <button type="submit">Submit</button>
</form>
