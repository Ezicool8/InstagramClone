<form action="/testStore" method='POST'>
    @csrf
    <h1>Fill the form below</h1>
    <label for="title">Title</label>
    <input type="text" id="title" name="title" >

    <label for="details">Details</label>
    <input type="text" id="details" name="details" >
    <button type="submit">Submit Data</button>
</form>