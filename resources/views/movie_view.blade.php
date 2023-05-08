<!-- In your blade view -->
<!DOCTYPE html>
<html>
  <head>
    <title>Create Movie</title
    <link href="css/app.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
    <div class="container">
    <h1>Movies</h1>
    <form method="get" action="{{ route('movies.index') }}">
      <div class="form-group row">
        <label for="release_date" class="col-sm-2 col-form-label">Release Date</label>
        <div class="col-sm-10">
          <input type="date" class="form-control" id="release_date" name="release_date" value="{{ old('release_date') }}">
        </div>
      </div>
      <div class="form-group row">
        <label for="genres" class="col-sm-2 col-form-label">Genres</label>
        <div class="col-sm-10">
          <select class="form-control" id="genres" name="genres[]">
            @foreach($genres as $genre)
              <option value="{{ $genre->id }}" {{ in_array($genre->id, old('genres', [])) ? 'selected' : '' }}>{{ $genre->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="actors" class="col-sm-2 col-form-label">Actors</label>
        <div class="col-sm-10">
          <select class="form-control" id="actors" name="actors[]">
            @foreach($actors as $actor)
              <option value="{{ $actor->id }}" {{ in_array($actor->id, old('actors', [])) ? 'selected' : '' }}>{{ $actor->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
          <button type="submit" class="btn btn-primary">Filter</button>
        </div>
      </div>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Release Date</th>
          <th>Genres</th>
          <th>Actors</th>
        </tr>
      </thead>
      <tbody>
        @foreach($movies as $movie)
          <tr>
            <td>{{ $movie->name }}</td>
            <td>{{ $movie->release_date }}</td>
            <td>{{ $movie->genre }} </td>
            <td>{{ $movie->actor }} </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
 </body>
</html>
