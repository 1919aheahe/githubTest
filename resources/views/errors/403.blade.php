@extends('errors.layouts.base')

@section('title', '403 Forbidden')

@section('message', 'You do not have access.')
{{-- あなたにはアクセス権がありません。 --}}

@section('detail', 'It indicates that the client does not have access to the content and the server is refusing to reply the appropriate response.')
{{-- クライアントがコンテンツへのアクセス権を持たず、サーバーが適切な応答への返信を拒否していることを示します。 --}}