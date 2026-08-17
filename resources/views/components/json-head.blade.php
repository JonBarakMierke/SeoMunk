@if(config('seomunk.schema.include_organization'))
{!! SeoMunk::schema()->withOrganization()->render() !!}
@endif

{!! $schemas !!}
