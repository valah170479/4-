<!-- Title -->
    <div class="section-title">
      <h2>{{$title}}</h2>
    </div><br>
    <!--/Title --> 


<div style="margin: 30px;">  
<div class="section-title text-center">
      <h3> {{ $sections->links() }}</h3>
    </div> 

@if($sections)
 
	<table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>№ п/п</th>
                <th>Логотип</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Работники</th>
                <th>Дата создания</th>
                 <th>Редактировать</th>
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>
     <?php if (!Auth::user()) { 

               echo '<h3>  Для добавления, редактирования, удаления отдела у Вас должны быть права Админа</h3><br><hr>';
              } ?>
             
        @foreach($sections as $k => $section)
        
        	<tr>
        	
        		<td>{{ $section->id }}</td>
        		

        		<td>
                    {!! Html::image('assets/img/'.$section->logo,'',['class'=>'img-circle img-responsive','width'=>'150px']) !!}
                    
               </td>

                <td>{{ $section->name }}</td>
        		<td>{{ $section->description}}</td>
        		<td>{{ $section->user_id }}</td>
        		<td>{{ $section->created_at }}</td>

              
            <?php
             if (Auth::user()) {

             if((Auth::user()->admin) == 1) { ?>
                  <td>
  <a href="{{ route('sectionsEdit',['section'=>$section->id]) }}">
                 <button class="btn btn-primary">Редактировать
                 </button>
                   </a>
               </td>


        		<td>
	        		{!! Form::open(['url'=>route('sectionsEdit',['section'=>$section->id]), 'class'=>'form-horizontal','method' => 'POST']) !!}
	        			
	        			{{method_field('DELETE')}}
	        			{!! Form::button('Удалить',['class'=>'btn btn-danger','type'=>'submit']) !!}
	        			
	        		{!! Form::close() !!}
        		</td>
              <?php } 
          } 
          ?>
        	</tr>
        
        @endforeach
        
		
        </tbody>
    </table>
@endif 
 
<?php 
if (Auth::user()) {

if((Auth::user()->admin) == 0)  
    { echo Auth::user()->name.'<h3> - Для добавления, редактирования, удаления отдела у Вас должны быть права Админа</h3>'; 

 } else { ?>

  {!!Html::link(route('sectionsAdd'),'Новый отдел') !!}

<?php }
}
?>
   
   
</div>