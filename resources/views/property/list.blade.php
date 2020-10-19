@extends('master')

@section('title')
    Available Properties
@endsection

@section('content')
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Number of Bedrooms</th>
                <th>Price</th>
                <th>Property Type</th>
                <th>Deal Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
            <tr>
                <td>{{$property->uuid}}</td>
                <td>{{$property->num_bedrooms}}</td>
                <td>{{$property->getPriceFormatted()}}</td>
                <td>{{$property->property_type_title}}</td>
                <td>{{$property->type->getValue()}}</td>
                <td>
                    <a href="{{$property->getUrl()}}">view</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection