@extends('layouts.admin')

@include('host.add-accommodation-base', ['formRoute' => route('admin.accommodation-create', ['userId' => $user->id])])

