
                const inputs = document.getElementsByTagName("input");
                for(let input of inputs)
                {
                    input.addEventListener("keyup",function(e)
                    {
                        if(e.target.hasAttribute("error"))
                        {
                            var idDivError=e.target.getAttribute("error");
                            document.getElementById(idDivError).innerText="";
                        }
                    })
                }

                document.getElementById("mainform").addEventListener("submit",function(e)
                {   
                    const inputs=document.getElementsByTagName("input");
                    var error=false;
                    for(let input of inputs)
                    {
                        if(input.hasAttribute("error"))
                        {
                            var idDivError = input.getAttribute("error");
                            if(!input.value)
                            {
                                document.getElementById(idDivError).innerText='ce champ est obligatoitre';
                                error=true;
                            }
                        }

                    }
                    if(error)
                    {
                        e.preventDefault();
                        return false;
                    }
                })