@if ($arr_pagination->lastPage() > 1 && isset($arr_pagination))
<?php $arr_pagination->appends(\Request::all()); ?>
<div class="pegonasd text-right">
   <ul class="pagination">
    @if($arr_pagination->currentPage() > 1)
      <li class="disabled bg-redss {{ ($arr_pagination->currentPage() == 1) ? '' : '' }}">
         <a aria-label="Previous"  href="{{ $arr_pagination->url(1) }}">
         <i class="fa fa-angle-left"></i>
         </a>
      </li>
     @endif 
      @for ($i = 1; $i <= $arr_pagination->lastPage(); $i++)
      <?php $page = $arr_pagination->currentPage();
            if($page==$i)
            {
              $cls  = "active"; 
            }
            else
            {
              $cls = "";
            }
      ?>
      
       <li class="{{$cls}}">
         <a href="{{ $arr_pagination->url($i) }}">{{ $i }}</a>
       </li>
      @endfor
       @if($arr_pagination->currentPage() < $arr_pagination->lastPage())
      <li class="bg-redss {{ ($arr_pagination->currentPage() == $arr_pagination->lastPage()) ? '' : '' }}">
         <a aria-label="Next" href="{{ $arr_pagination->url($arr_pagination->currentPage()+1) }}">
         <i class="fa fa-angle-right"></i>
         </a>
      </li>
      @endif
   </ul>
</div>
@endif


