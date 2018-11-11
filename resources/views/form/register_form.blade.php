@extends('layouts.basic')

@section('content')
    <div class="container">
        <h2>회원가입 폼</h2>
        <p>회원가입을 위해 아래의 정보를 작성해주세요.</p>
        <form action="register_ok.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="usr">ID</label>
                <input type="text" class="form-control" name="user_id" placeholder="Set your ID" required>
            </div>
            <div class="form-group">
                <label for="usr">Password</label>
                <input type="password" class="form-control" name="user_pw" placeholder="Set your Password" required>
            </div>
            <div class="form-group">
                <label for="usr">Name</label>
                <input type="text" class="form-control" name="user_name" placeholder="Set your Name" required>
            </div>
            <div class="form-group">
                <label for="usr">E-mail</label>
                <input type="text" class="form-control" name="email" placeholder="Set your Name" required>
            </div>
            <div class="form-group">
                <label for="usr">Address</label>
                <input type="text" class="form-control"  name="addr" placeholder="Set your Name" required>
            </div>
            <div class="form-group">
                <label for="image">Select image to upload : </label>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
@endSection