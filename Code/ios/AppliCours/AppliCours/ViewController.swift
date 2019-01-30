//
//  ViewController.swift
//  AppliCours
//
//  Created by ramousset vincent on 23/01/2019.
//  Copyright © 2019 ramousset vincent. All rights reserved.
//

import UIKit

class ViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
        fetchPhotoInfos { (cours) in
            print(cours)
        }
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


    func fetchPhotoInfos(completion: @escaping (Cours?) -> Void) {
        let url = URL(string: "http://www-etu.iut-bm.univ-fcomte.fr/~vramouss/Code/api/cours/read.php")!
        
        /*let query: [String: String] = [
            "api_key": "abONaFIip0FrAmEcZLiXbZqIUw2r7dOUPmRFWZMN"/*,
             "date": "2011-07-13"*/
        ]
        
        
        let url = baseURL.withQueries(query)!*/
        
        let task = URLSession.shared.dataTask(with: url) { (data, response, error) in
            let jsonDecoder = JSONDecoder()
            print(data)
            if let data = data, let cours = try? jsonDecoder.decode([Cours].self, from: data) {
                completion(cours)
            } else {
                completion(nil)
            }
        }
        
        task.resume()
    }
    
    /*func updateUI(_ photoInfo: PhotoInfo?){
        if let info = photoInfo {
            let url = info.url
            
            let task = URLSession.shared.dataTask(with: url) { (data, response, error) in
                if let data = data {
                    
                    DispatchQueue.main.async {
                        self.labelTitre.text = info.title
                        self.image.image = UIImage(data: data)
                        self.labelA.text = info.description
                        self.labelB.text = info.copyright
                    }
                }
            }
            
            task.resume()
        }
    }*/
}

